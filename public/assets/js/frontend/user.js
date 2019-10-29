define(['jquery', 'bootstrap', 'frontend', 'form', 'template'], function ($, undefined, Frontend, Form, Template) {
    /*
    崔思思测试发送ajax
    */

    var validatoroptions = {
        invalid: function (form, errors) {
            $.each(errors, function (i, j) {
                Layer.msg(j);
            });
        }
    };
    var Controller = {
        charlierecharge: function () {
            //   点击查询的按钮
            $(document).on("click", ".inquire", function () {
                has_pwd = $('#cardpass').val()
                window.location.href = "http://localhost:777/index/user/findhaspwd.html?has_pwd=" + has_pwd
            });

        },
        findhaspwd: function () {
            // 点击兑换的按钮
            $(document).on("click", ".conversion", function () {
                $.ajax({
                    url: "http://api2.ceh.com.cn/fav/has",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        target: '319541621429371350',
                        userid: '319430217930703154',
                        user_id: '319430217930703154'
                    },
                    success: function (ret) {
                        // 现在随便一个的接口
                        if (ret.result == "ok") {
                            Toastr.success("成功");
                        } else {
                            Toastr.success("失败");
                        }
                        // 你自己的接口用这个
                        // if(ret.msg=="成功"){
                        //     Toastr.success("成功");
                        // }else{
                        //     Toastr.success("失败");
                        // }
                    },
                    error: function (e) {

                    }
                });
            })
        },

        exchangepoints: function () {
            //选择兑换点数的列表
            $.ajax({
                url: "/index/user/getserverlist",
                type: 'get',
                dataType: 'json',
                data: {},
                success: function (ret) {
                    ret.forEach(function (e) {
                        var optionsItem = document.createElement("option");
                        optionsItem.innerHTML = e.name;
                        optionsItem.value = e.price
                        var selectpicker = document.querySelector(".selectpicker")
                        selectpicker.appendChild(optionsItem);
                    })

                },
                error: function (e) {

                }
            });

            $(".duihuannum").on(" input propertychange", function () {
                var selectValue = $("#selectpicker").val();
                var num = $(".duihuannum").val();
                document.querySelector(".totalNum").innerHTML = selectValue * num
            });
            $("#selectpicker").change(() => {
                var selectValue = $("#selectpicker").val();
                var num = $(".duihuannum").val();
                if (num != "" && num != 0) {
                    document.querySelector(".totalNum").innerHTML = selectValue * num
                }
            });
            // 点击兑换的按钮
            $(document).on("click", ".btn-embossed", function () {
                var selectValue = $("#selectpicker").val();
                var num = $(".duihuannum").val();
                if (num == "" && num == 0) {
                    layer.msg('输入数量');
                }

                $.ajax({
                    url: "/index/user/buttenexchangepoints",
                    type: 'get',
                    dataType: 'json',
                    data: {
                        number: num,
                        amount_id: selectValue,
                    },
                    success: function (ret) {

                        Toastr.success(ret.msg);

                        return false;
                    },
                    error: function (e) {

                    }
                });
            })

        },
        mainaccountnumber: function () {
            // 点击查询
            $(document).on("click", ".blacksearch", function () {
                var passid = $("#ipaddress").val();
                // $.ajax({
                //     url: "/index/user/blacklistedQuery",
                //     type: 'get',
                //     dataType: 'json',
                //     data: {
                //         ip: passid
                //     },
                //     success: function (ret) {
                //         if (ret.message == "success" && ret.data.searchList) {
                //             var res = ret.data.searchList
                //             var content = "<div>ip:" + res.remote_ip + "</div><div>创建时间：" + res.create_time + "</div><div>名称:" + res.acc + "</div><div>屏蔽时长:" + res.lot + "</div><div>原因:" + res.message + "</div>"
                //             Layer.open({
                //                 type: 1,
                //                 title: '信息',
                //                 area: ["300px", "200px"],
                //                 content: content,
                //                 skin: 'demo-class',
                //                 success: function (layero) {

                //                 }
                //             });

                //         }
                //     },
                //     error: function (e) {

                //     }
                // });
                var content = "<div>ip:456789</div><div>ip:456789</div><div>名称:test</div><div>屏蔽时长:3天</div><div>原因:黄赌毒</div>"
                Layer.open({
                    type: 1,
                    title: '信息',
                    area: ["300px", "200px"],
                    content: content,
                    skin: 'demo-class',
                    success: function (layero) {

                    }
                });
            });
            // 点击解除
            $(document).on("click", ".blackjiechu", function () {
                var passid = $("#ipaddress").val();
                // $.ajax({
                //     url: "/index/user/deleteBlack",
                //     type: 'get',
                //     dataType: 'json',
                //     data: {
                //         ip: passid
                //     },
                //     success: function (ret) {
                //         if (ret.message == "success" && ret.data.searchList) {
                //             var res = ret.data.searchList
                //             var content = "<div>ip:" + res.remote_ip + "解除成功</div><div>请立马解决触发原因</div><div>否则会再次发生屏蔽</div>"
                //             Layer.open({
                //                 type: 1,
                //                 title: '信息',
                //                 area: ["300px", "200px"],
                //                 content: content,
                //                 skin: 'demo-class',
                //                 success: function (layero) {

                //                 }
                //             });

                //         }
                //     },
                //     error: function (e) {

                //     }
                // });
                var content = "<div>ip:" + passid+ "解除成功</div><div>请立马解决触发原因</div><div>否则会再次发生屏蔽</div>"
                if(passid==""){
                    content="输入账号不能为空"
                }
                Layer.open({
                    type: 1,
                    title: '信息',
                    area: ["250px", "150px"],
                    content: content,
                    skin: 'demo-class',
                    success: function (layero) {

                    }
                });
            });

        },

        login: function () {
            //本地验证未通过时提示
            $("#login-form").data("validator-options", validatoroptions);

            $(document).on("change", "input[name=type]", function () {
                var type = $(this).val();
                $("div.form-group[data-type]").addClass("hide");
                $("div.form-group[data-type='" + type + "']").removeClass("hide");
                $('#resetpwd-form').validator("setField", {
                    captcha: "required;length(4);integer[+];remote(" + $(this).data("check-url") + ", event=resetpwd, " + type + ":#" + type + ")",
                });
                $(".btn-captcha").data("url", $(this).data("send-url")).data("type", type);
            });

            //为表单绑定事件
            Form.api.bindevent($("#login-form"), function (data, ret) {
                setTimeout(function () {
                    location.href = ret.url ? ret.url : "/";
                }, 1000);
            });

            Form.api.bindevent($("#resetpwd-form"), function (data) {
                Layer.closeAll();
            });

            $(document).on("click", ".btn-forgot", function () {
                var id = "resetpwdtpl";
                var content = Template(id, {});
                Layer.open({
                    type: 1,
                    title: __('Reset password'),
                    area: ["450px", "355px"],
                    content: content,
                    success: function (layero) {
                        Form.api.bindevent($("#resetpwd-form", layero), function (data) {
                            Layer.closeAll();
                        });
                    }
                });
            });
        },
        register: function () {
            //本地验证未通过时提示
            $("#register-form").data("validator-options", validatoroptions);

            //为表单绑定事件
            Form.api.bindevent($("#register-form"), function (data, ret) {
                setTimeout(function () {
                    location.href = ret.url ? ret.url : "/";
                }, 1000);
            }, function (data) {
                $("input[name=captcha]").next(".input-group-addon").find("img").trigger("click");
            });
        },
        changepwd: function () {
            //本地验证未通过时提示
            $("#changepwd-form").data("validator-options", validatoroptions);

            //为表单绑定事件
            Form.api.bindevent($("#changepwd-form"), function (data, ret) {
                setTimeout(function () {
                    location.href = ret.url ? ret.url : "/";
                }, 1000);
            });
        },
        profile: function () {
            // 给上传按钮添加上传成功事件
            $("#plupload-avatar").data("upload-success", function (data) {
                var url = Fast.api.cdnurl(data.url);
                $(".profile-user-img").prop("src", url);
                Toastr.success(__('Upload successful'));
            });
            Form.api.bindevent($("#profile-form"));
            $(document).on("click", ".btn-change", function () {
                var that = this;
                var id = $(this).data("type") + "tpl";
                var content = Template(id, {});
                Layer.open({
                    type: 1,
                    title: "修改",
                    area: ["400px", "250px"],
                    content: content,
                    success: function (layero) {
                        var form = $("form", layero);
                        Form.api.bindevent(form, function (data) {
                            location.reload();
                            Layer.closeAll();
                        });
                    }
                });
            });
        },

    };
    return Controller;
});