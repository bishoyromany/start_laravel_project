<template>
    <div id="addComponent">
        <div class="card text-white bg-dark">
            <div class="card-header">
                Edit {{form.name}} {{showDetails.name}}
                <br />
                <small @click="enableDebug()">{{debug ? 'Disable' : 'Enable'}} Debug Mode</small>
            </div>

            <div class="card-body">
                <form @submit.prevent="update">
                    <div class="form-group" v-for="f in formDetails" v-bind:key="f.name">
                        <div
                            class="row"
                            v-if="f.type != 'editor' && f.type != 'tag' && f.type != 'listedCheckbox' && f.type != 'tags'"
                        >
                            <div class="col-md-3">
                                <label :for="f.column">{{f.name}}</label>
                            </div>
                            <div class="col-md-9">
                                <template
                                    v-if="f.type != 'selectbox' && f.type != 'textarea' && f.type != 'editor' && f.type != 'tag'"
                                >
                                    <input
                                        v-if="!f.between"
                                        :type="f.type"
                                        :required="f.required ? '' : false"
                                        :placeholder="f.placeholder"
                                        v-model="form[f.column]"
                                        :id="f.column"
                                        :class="f.class"
                                    />

                                    <template v-if="f.between">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input
                                                    :type="f.type"
                                                    :placeholder="f.placeholder+ ' Start'"
                                                    v-model="form[f.column+ 'Start']"
                                                    :id="f.column+ 'Start'"
                                                    :class="f.class+ ' Start'"
                                                    @change="handleBetween(f.column)"
                                                />
                                            </div>

                                            <div class="col-md-6">
                                                <input
                                                    :type="f.type"
                                                    :placeholder="f.placeholder+ ' End'"
                                                    v-model="form[f.column+ 'End']"
                                                    :id="f.column+ 'End'"
                                                    :class="f.class+ ' End'"
                                                    @change="handleBetween(f.column)"
                                                />
                                            </div>

                                            <div class="col-md-12" v-if="debug">
                                                <input
                                                    type="text"
                                                    :required="f.required ? '' : false"
                                                    :placeholder="f.placeholder"
                                                    v-model="form[f.column]"
                                                    :id="f.column"
                                                    :class="f.class"
                                                />
                                            </div>
                                        </div>
                                    </template>
                                </template>

                                <textarea
                                    v-else-if="f.type == 'textarea'"
                                    :required="f.required ? '' : false"
                                    :placeholder="f.placeholder"
                                    v-model="form[f.column]"
                                    :id="f.column"
                                    :class="f.class"
                                ></textarea>
                                <select
                                    v-else
                                    :type="f.type"
                                    :required="f.required ? '' : false"
                                    v-model="form[f.column]"
                                    :id="f.column"
                                    :multiple="f.multiple ? true : false"
                                    :class="f.class"
                                >
                                    <option
                                        v-for="v in f.items"
                                        v-bind:key="v[f.value]"
                                        :value="v[f.value]"
                                    >{{v[f.show]}}</option>
                                </select>
                            </div>
                        </div>
                        <div v-else-if="f.type == 'editor'">
                            <label :for="f.column">{{f.name}}</label>
                            <tinymce v-model="form[f.column]" :id="f.column" class="tinymce"></tinymce>
                        </div>
                        <div v-else-if="f.type == 'tag'">
                            <div class="row">
                                <div class="col-md-3">
                                    <label :for="f.column">{{f.name}}</label>
                                </div>
                                <div class="col-md-9">
                                    <VueTagsInput
                                        :placeholder="f.placeholder"
                                        v-model="form[f.subColumn]"
                                        :tags="jsonData(form[f.column])"
                                        :allow-edit-tags="true"
                                        :separators="[',']"
                                        :autocomplete-filter-duplicates="false"
                                        :avoid-adding-duplicates="false"
                                        @tags-changed="newTags => form[f.column] = newTags"
                                        :autocomplete-items="filterData(f.autocomplete , form[f.subColumn])"
                                    />
                                    Current Tags Amount Is : {{form[f.column] != null? JSON.parse(form[f.column]).length : 0}}
                                </div>
                            </div>
                        </div>

                        <div v-else-if="f.type == 'tags'">
                            <ol>
                                <li v-for="(x, tagIndex) in form[f.column]" v-bind:key="x">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <input
                                                type="text"
                                                v-model="form[f.column][tagIndex]"
                                                class="form-control"
                                            />
                                        </div>
                                        <div
                                            class="col-md-1"
                                            @click="removeTag(f.column, tagIndex)"
                                        >
                                            <i class="fa fa-trash text-danger"></i>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                            <div class="row">
                                <div class="col-md-3">
                                    <label :for="f.column">{{f.name}}</label>
                                </div>
                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        :required="f.required ? '' : false"
                                        :placeholder="f.placeholder"
                                        v-model="form[f.subColumn]"
                                        :id="f.column"
                                        :class="f.class"
                                    />
                                    <div class="row">
                                        <div class="col-md-4 offset-4">
                                            <span
                                                class="btn btn-block btn-success"
                                                @click="addTag(f.column, f.subColumn)"
                                            >Add</span>
                                        </div>
                                    </div>
                                    Current Tags Amount Is : {{form[f.column].length}}
                                </div>
                            </div>
                        </div>

                        <div v-else-if="f.type == 'listedCheckbox'">
                            <div class="row">
                                <div class="col-md-3">
                                    <label :for="f.column">{{f.name}}</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="listedCheckboxLabel">
                                        All
                                        <input
                                            type="checkbox"
                                            value="all"
                                            @click="handleCheckbox($event, f.column)"
                                        />
                                    </label>
                                    <label
                                        v-for="(vv, i) in [...Array(f.value)]"
                                        v-bind:key="i"
                                        class="listedCheckboxLabel"
                                    >
                                        {{i}}
                                        <!-- v-model="form[f.column] -->
                                        <input
                                            :value="i"
                                            type="checkbox"
                                            :checked="form[f.column].includes(i)"
                                            :class="f.column"
                                            :ref="f.column+'[]'"
                                            @click="handleCheckbox($event, f.column)"
                                        />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-success btn-block">
                                Edit {{showDetails.name}}
                                <i class="fa fa-edit"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <code v-if="debug">
                    <pre style="color : #FFF;">
                        {{form}}
                    </pre>
                </code>
            </div>
        </div>
    </div>
</template>

<script>
import tinymce from "vue-tinymce-editor";
export default {
    name: "EditComponent",
    props: {
        user: {
            type: Object,
            require: true
        },
        formDetails: {
            require: true,
            type: Array
        },
        showDetails: {
            require: true,
            type: Object
        }
    },
    components: {
        tinymce
    },
    data() {
        return {
            debug: false,
            form: {}
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.form = this.user;
            if (this.form["conditions"]) {
                this.form["conditions"] = [
                    ...new Set(this.jsonData(this.form["conditions"]))
                ];
            }
            for (let x in this.form) {
                this.formDetails.map((item) => {
                    if (item.column == x) {
                        if (
                            item.type == "listedCheckbox" ||
                            item.type == "tags" ||
                            item.json
                        ) {
                            this.form[x] = [
                                ...new Set(this.jsonData(this.form[x]))
                            ];
                        } else if (item.between) {
                            if (this.form[x].length > 3) {
                                let betweens = this.form[x].split("___");
                                this.form[x + "Start"] = betweens[0];
                                this.form[x + "End"] = betweens[1];
                            }
                        }
                    }
                });
            }
        },
        update() {
            this.$emit("updateItem", this.form);
        },
        enableDebug() {
            this.debug = !this.debug;
        },
        filterData(items, text) {
            let newText = text ? text.toLowerCase() : "";
            return items.filter((item) => {
                return item.toLowerCase().indexOf(newText) !== -1;
            });
        },
        addTag(main, sub) {
            console.log(this.form[sub], typeof this.form[main]);
            this.form[main].push(this.form[sub]);
            this.$forceUpdate();
        },
        removeTag(main, index) {
            this.form[main].splice(index, 1);
        },
        jsonData(data) {
            if (data == null) {
                return ["NULL"];
            } else {
                let done = false;
                let limit = 5;
                let x = 0;
                let result = JSON.parse(data);
                while (!done && x < limit) {
                    if (typeof result == "string") {
                        result = JSON.parse(data);
                    } else {
                        done = true;
                    }
                    x++;
                }
                return result;
            }
        },
        handleCheckbox(e, column) {
            if (this.form[column] == undefined) {
                this.form[column] = [];
            } else if (typeof this.form[column] != "object") {
                this.form[column] = JSON.parse(this.form[column]);
            }

            if (e.target.value == "all") {
                let d = document.querySelectorAll(`.${column}`);
                for (let x of d) {
                    x.checked = e.target.checked;
                    if (e.target.checked) {
                        if (!this.form[column].includes(parseInt(x.value))) {
                            this.form[column].push(parseInt(x.value));
                        }
                    } else {
                        this.form[column] = this.form[column].filter((i) => {
                            return i != parseInt(x.value);
                        });
                    }
                }
            } else {
                if (!e.target.checked) {
                    this.form[column] = this.form[column].filter((i) => {
                        return i != e.target.value;
                    });
                } else {
                    if (!this.form[column].includes(e.target.value)) {
                        this.form[column].push(parseInt(e.target.value));
                    }
                }
            }
        },
        handleBetween(column) {
            let startBetween = this.form[column + "Start"];
            let endBetween = this.form[column + "End"];
            if (startBetween.length > 0 && endBetween.length > 0) {
                this.form[column] = startBetween + "___" + endBetween;
            } else {
                this.form[column] = null;
            }
        }
    }
};
</script>

<style lang="scss">
#addComponent {
    z-index: 1000;
    max-height: 80vh;
    overflow: auto;
    .ti-autocomplete {
        background-color: #555 !important;
    }
    .listedCheckboxLabel {
        padding: 10px;
        border: 1px solid #eee;
        margin: 2.5px;
        vertical-align: middle;
        cursor: pointer;
    }
}
</style>