<template>
    <div id="addComponent">
        <div class="card text-white bg-dark">
            <div class="card-header">
                <small class="text-small">
                    Leave Empty all Values You Don't Wanna Edit
                    <i class="fa fa-faq"></i>.
                    <br />
                </small>
                Edit All {{showDetails.name}}
            </div>

            <div class="card-body">
                <form @submit="store($event)">
                    <div class="form-group" v-for="f in formDetails" v-bind:key="f.name">
                        <div class="row" v-if="f.type != 'editor' && f.type != 'tag'">
                            <div class="col-md-3">
                                <label :for="f.column">{{f.name}}</label>
                            </div>
                            <div class="col-md-9">
                                <input
                                    v-if="f.type != 'selectbox' && f.type != 'textarea' && f.type != 'editor' && f.type != 'tag'"
                                    :type="f.type"
                                    :placeholder="f.placeholder"
                                    v-model="form[f.column]"
                                    :id="f.column"
                                    :class="f.class"
                                />
                                <textarea
                                    v-else-if="f.type == 'textarea'"
                                    :placeholder="f.placeholder"
                                    v-model="form[f.column]"
                                    :id="f.column"
                                    :class="f.class"
                                ></textarea>
                                <select
                                    v-else
                                    :type="f.type"
                                    v-model="form[f.column]"
                                    :id="f.column"
                                    :class="f.class"
                                >
                                    <option :value="''">Leave Empty</option>
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
                                        :tags="form[f.column]"
                                        :allow-edit-tags="true"
                                        :autocomplete-filter-duplicates="false"
                                        :avoid-adding-duplicates="false"
                                        :separators="[',']"
                                        @tags-changed="newTags => form[f.column] = newTags"
                                        :autocomplete-items="filterData(f.autocomplete , form[f.subColumn])"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-success btn-block">
                                Edit All {{showDetails.name}}
                                <i class="fa fa-edit"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import tinymce from "vue-tinymce-editor";
import VueTagsInput from "@johmun/vue-tags-input";

export default {
    name: "edit-all-component",
    props: {
        clonedItem: {
            type: Object
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
        tinymce,
        VueTagsInput
    },
    data() {
        return {
            form: {}
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.form = {};
            for (let x in this.clonedItem) {
                if (x != "tasks" && !this.clonedItem[x].json) {
                    this.form[x] = this.clonedItem[x];
                } else {
                    this.form[x] = JSON.parse(this.clonedItem[x]);
                }
            }
        },
        store(e) {
            e.preventDefault();
            let newForm = {};
            for (let k in this.form) {
                if (
                    (typeof this.form[k] == "number" && this.form[k] >= 0) ||
                    this.form[k].length >= 1
                ) {
                    newForm[k] = this.form[k];
                }
            }
            this.$emit("editAll", newForm);
        },
        console(msg) {
            console.log(msg);
        },
        filterData(items, text) {
            let newText = text ? text.toLowerCase() : "";
            return items.filter(item => {
                return item.toLowerCase().indexOf(newText) !== -1;
            });
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
}
</style>