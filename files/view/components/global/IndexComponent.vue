<template>
    <div id="Index">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped table-dark">
                <thead>
                    <tr>
                        <th v-if="select">
                            <input type="checkbox" v-model="selectAll" @click="selectItems()" />
                        </th>
                        <th
                            v-for="c in columns"
                            v-bind:key="c.name"
                            @click="order(c.column , c.order.length > 0 ? c.order : 'ASC')"
                        >
                            {{c.name}}
                            <span class="order" v-if="c.order.length == 0">
                                <i class="fa fa-sort"></i>
                            </span>

                            <span class="order_up" v-if="c.order == 'ASC'">
                                <i class="fa fa-arrow-up"></i>
                            </span>

                            <span class="order_down" v-if="c.order == 'DESC'">
                                <i class="fa fa-arrow-down"></i>
                            </span>
                        </th>
                        <th v-if="actions.length > 0">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user , index) in users" v-bind:key="user.id">
                        <td v-if="select">
                            <input
                                type="checkbox"
                                v-model="selectItem[index]"
                                @click="selectItems(index)"
                            />
                        </td>

                        <td v-for="c in columns" v-bind:key="c.column">
                            <span
                                class="text-white"
                                :href="user.showUrl"
                                @click="show(index)"
                                v-if="c.condition"
                            >{{c.if ? user[c.column] == 1 ? 'Yes' : 'No' : c.condition[user[c.column]] ? c.condition[user[c.column]] : user[c.column] }}</span>
                            <span
                                class="text-white"
                                :href="user.showUrl"
                                @click="show(index)"
                                v-else-if="!c.subColumn"
                            >{{c.if ? user[c.column] == 1 ? 'Yes' : 'No' : user[c.column]}}</span>
                            <span
                                class="text-white"
                                :href="user.showUrl"
                                @click="show(index)"
                                v-else-if="c.subColumn && user[c.column] != undefined"
                            >{{c.if ? user[c.column][c.subColumn] == 1 ? 'Yes' : 'No' : user[c.column][c.subColumn]}}</span>
                        </td>

                        <td>
                            <div>
                                <a
                                    :href="user.editUrl"
                                    @click.prevent="$emit('cloneItem' , index)"
                                    v-if="actions.includes('CloneItem')"
                                    class="btn btn-success"
                                >
                                    <i class="fa fa-clone fa-fw"></i>
                                </a>
                                <a
                                    @click.prevent="DeleteItem(index)"
                                    v-if="actions.includes('DeleteItem')"
                                    :href="user.deleteUrl"
                                    class="btn btn-danger"
                                >
                                    Delete
                                    <i class="fa fa-times fa-fw"></i>
                                </a>
                                <a
                                    :href="user.editUrl"
                                    @click.prevent="editUser(user.editUrl)"
                                    v-if="actions.includes('EditItem')"
                                    class="btn btn-info"
                                >
                                    Edit
                                    <i class="fa fa-edit fa-fw"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        users: {
            required: true,
            type: Array
        },
        actions: {
            require: true,
            type: Array
        },
        columns: {
            require: true,
            type: Array
        },
        select: {
            require: false,
            type: Boolean,
            default: false
        }
    },
    name: "IndexComponent",
    data() {
        return {
            selectedItems: [],
            selectAll: false,
            selectItem: this.handleSelectStart()
        };
    },
    created() {
        window.setInterval(() => {
            this.$forceUpdate();
        }, 1000);
    },
    methods: {
        handleSelectStart(status = false) {
            let start = [];
            this.users.map((item, index) => {
                start[index] = status;
            });
            return start;
        },
        show(id) {
            this.$emit("showData", id);
        },
        editUser(url) {
            window.axios
                .get(url + "?api=1")
                .then((r) => {
                    this.$emit("editUser", r.data);
                })
                .catch((e) => {
                    console.log(e);
                });
        },
        order(column, type) {
            this.$emit("orderIndex", {
                column: column,
                type: type
            });
        },
        DeleteItem(index) {
            if (confirm("Are You Sure That You Want To Delete This Record?!")) {
                this.$emit("DeleteItem", index);
            }
        },
        selectItems(index = false) {
            if (index === false) {
                if (!this.selectAll) {
                    this.selectItem = this.handleSelectStart(true);
                } else {
                    this.selectItem = this.handleSelectStart(false);
                }
            }
            setTimeout(() => {
                this.hndleSelectedItems();
            }, 50);
        },
        hndleSelectedItems() {
            for (let k in this.selectItem) {
                if (this.selectItem[k] === true) {
                    this.selectedItems[k] = this.users[k];
                } else {
                    this.selectedItems[k] = false;
                }
            }

            setTimeout(() => {
                this.$emit("selected", this.selectedItems);
            }, 50);
        }
    },
    watch: {
        users() {
            console.log("changed");
            this.$forceUpdate();
        },
        users: {
            handler() {
                this.handleSelectStart();
                this.hndleSelectedItems();
            },
            deep: true
        }
    }
};
</script>

<style lang="scss" scoped>
th {
    cursor: pointer;
}
.hide {
    display: none;
}
</style>
