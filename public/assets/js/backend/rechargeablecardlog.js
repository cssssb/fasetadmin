define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'rechargeablecardlog/index' + location.search,
                    add_url: 'rechargeablecardlog/add',
                    edit_url: 'rechargeablecardlog/edit',
                    del_url: 'rechargeablecardlog/del',
                    multi_url: 'rechargeablecardlog/multi',
                    table: 'rechargeablecardlog',
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
                        {field: 'describe', title: __('Describe')},
                        {field: 'user_id', title: __('User_id')},
                        {field: 'user_name', title: __('User_name')},
                        {field: 'number', title: __('Number')},
                        {field: 'remainder', title: __('Remainder')},
                        {field: 'c_time', title: __('C_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'type', title: __('Type')},
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