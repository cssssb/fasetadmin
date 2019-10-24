define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'exchangelog/index' + location.search,
                    add_url: 'exchangelog/add',
                    edit_url: 'exchangelog/edit',
                    del_url: 'exchangelog/del',
                    multi_url: 'exchangelog/multi',
                    table: 'exchange_log',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'update_number', title: __('Update_number')},
                        {field: 'before_number', title: __('Before_number')},
                        {field: 'after_number', title: __('After_number')},
                        {field: 'remarks', title: __('Remarks')},
                        {field: 'manage', title: __('Manage')},
                        {field: 'state', title: __('State')},
                        {field: 'amount_id', title: __('Amount_id')},
                        {field: 'c_time', title: __('C_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'user_id', title: __('User_id')},
                        {field: 'user_name', title: __('User_name')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});