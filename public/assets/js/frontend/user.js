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
                console.log($("#cardpass").val())
                //选择兑换点数的列表
                $.ajax({
                    url: "/index/user/findhaspwd",
                    type: 'get',
                    dataType: 'json',
                    data: {
                        has_pwd: $("#cardpass").val()
                    },
                    success: function (ret) {
                        if(ret.data==null){
                            layer.msg("无此账号")
                            return
                        }

                        var optionsItem = document.createElement("tr");
                        var tab = "<td>" + ret.data.has_pwd + "</td><td>" + ret.data.price + "</td><td>" + ret.data.number + "</td><td> </td></td><td class='passduihuan'>兑换</td>";
                        optionsItem.innerHTML = tab;
                        var tabbox = document.querySelector("#tabbox")
                        console.log(tabbox)
                        tabbox.appendChild(optionsItem);
                        $("#cardpass").val()=="";
                    },
                    error: function (e) {

                    }
                });

            });
            //   点的按钮
            $(document).on("click", ".passduihuan", function () {
                console.log($(this).parent().children("td:first-child").text())
                var pass=$(this).parent().children("td:first-child").text()
                //选择兑换点数的列表
                $.ajax({
                    url: "/index/user/hasexchange",
                    type: 'get',
                    dataType: 'json',
                    data: {
                        has_pwd: pass
                    },
                    success: function (ret) {
                        Toastr.success(ret.msg);
                    },
                    error: function (e) {

                    }
                });

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
        // 卡密充值
        exchangepoints: function () {
            var slsect

            //选择兑换点数的列表
            $.ajax({
                url: "/index/user/getserverlist",
                type: 'get',
                dataType: 'json',
                data: {},
                success: function (ret) {
                    slsect = ret
                    ret.forEach(function (e) {
                        var optionsItem = document.createElement("option");
                        optionsItem.innerHTML = e.name;
                        optionsItem.value = e.id
                        var selectpicker = document.querySelector(".selectpicker")
                        selectpicker.appendChild(optionsItem);
                    })

                },
                error: function (e) {

                }
            });

            $(".duihuannum").on(" input propertychange", function () {
                var selectId = $("#selectpicker").val();
                var price = slsect[selectId - 1].price;
                var num = $(".duihuannum").val();
                document.querySelector(".totalNum").innerHTML = price * num
            });
            $("#selectpicker").change(() => {
                var selectId = $("#selectpicker").val();
                var price = slsect[selectId - 1].price;
                var num = $(".duihuannum").val();
                if (num != "" && num != 0) {
                    document.querySelector(".totalNum").innerHTML = price * num
                }
            });
            // 点击兑换的按钮
            $(document).on("click", ".btn-embossed", function () {
                var selectId = $("#selectpicker").val();
                var num = $(".duihuannum").val();
                if (num == "" && num == 0) {
                    Toastr.success("请输入数量");
                }

                $.ajax({
                    url: "/index/user/buttenexchangepoints",
                    type: 'get',
                    dataType: 'json',
                    data: {
                        number: num,
                        amount_id: selectId,
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
            // 申请静态
            static: function () {
                // 城市列表
                $.ajax({
                    url: "/index/user/lineList",
                    type: 'get',
                    dataType: 'json',
                    data: {},
                    success: function (ret) {
                        ret.data.linkList.forEach(function (e) {
                            var optionsItem = document.createElement("option");
                            optionsItem.innerHTML = e.name;
                            optionsItem.value = e.id
                            var selectpicker = document.querySelector(".citypick")
                            selectpicker.appendChild(optionsItem);
                        })
                    },
                    error: function (e) {}
                });
                $.ajax({
                    url: "/index/user/getserverlist",
                    type: 'get',
                    dataType: 'json',
                    data: {},
                    success: function (ret) {
                        ret.forEach(function (e) {
                            var optionsItem = document.createElement("option");
                            optionsItem.innerHTML = e.name;
                            optionsItem.value = e.id
                            var selectpicker = document.querySelector(".selectpicker")
                            selectpicker.appendChild(optionsItem);
                        })
    
                    },
                    error: function (e) {}
                });
                // 创建静态账号
                $(document).on("click", ".staticbtn", function () {
    
                    //     for(var value of formData.values()){
                    // 	console.log(value)
                    // }
                    var param = {
                        'name': $('[name=name]').val(),
                        'password': $('[name= password]').val(),
                        'accountTotal': $('[name=accountTotal]').val(),
                        'defaultLink': $('[name=defaultLink]').val(),
                        "expireDate":$('[name=expireDate]').val(),
                        'isp': $('[name= isp]:checked').val(),
                        'serve_id': $('[name=serve_id]').val(),
                        'linkId': 9999
    
                    }
    
                    $.ajax({
                        url: "/index/user/agentCreate",
                        type: 'get',
                        dataType: 'json',
                        data: param,
                        success: function (ret) {
                              switch (ret.code) {
                            case 0:
                                Toastr.success("申请成功");
                                setTimeout(() => {
                                    window.location.reload()
                                }, 1000);
                                break;
                            case 1:
                                layer.msg("操作失败");
                                break;
                            case 2:
                                layer.msg("代理被禁用或删除");
                                break;
                            case 3:
                                layer.msg("sign计算错误或未提交");
                                break;
                            case 4:
                                layer.msg("参数完整性验证");
                                break;
                            case 5:
                                layer.msg("授权额度余额已用完");
                                break;
                            case 7||7:
                                layer.msg("账号名重复");
                                break;
                            case 8:
                                layer.msg("代理授权额度余额已用完");
                                break;
                            case 9:
                                layer.msg("被充值账号非按次计费模式");
                                break;
                            case 10:
                                layer.msg("被充值账号非包年包月模式");
                                break;
                            case 11:
                                layer.msg("默认线路未指定或不在授权范围内");
                                break;
                            default:
                                layer.msg("客户已存在");
                        }
                            

                            // Toastr.success("申请成功");
                            // setTimeout(() => {
                            //     window.location.reload() 
                            // },1000);
                           
                        },
                        error: function (e) {}
                    });
    
                });
    
            },
            staticlist: function () {
                $(document).on("click", ".bianji", function () {
                    $.ajax({
                        url: "/index/user/lineList",
                        type: 'get',
                        dataType: 'json',
                        data: {},
                        success: function (ret) {
                            ret.data.linkList.forEach(function (e) {
                                var optionsItem = document.createElement("option");
                                optionsItem.innerHTML = e.name;
                                optionsItem.value = e.id
                                var selectpicker = document.querySelector(".selectpicker")
                                selectpicker.appendChild(optionsItem);
                            })
    
                        },
                        error: function (e) {
    
                        }
                    });
                    Layer.open({
                        type: 1,
                        title: '信息',
                        area: ["650px", "450px"],
                        content: $(".staticxiugai"),
                        skin: 'demo-class',
                        success: function (layero) {
                            $(".staticxiugai").removeClass("hidden")
    
                        }
                    });
    
                });
    
                $("#toolbar").on("click", "div", function () {
                     var target= $(this).attr("class")
                     var content
                     if(target=="gouxuan"){
                        content=$(".checkedcontent")
                     }else if(target=="staticgroup"){
                        content=$(".staticcontent")
                     }else{
                        content=$(".otherprop")
                     }
                    Layer.open({
                        type: 1,
                        title: '信息',
                        area: ["650px", "450px"],
                        content: content,
                        skin: 'demo-class',
                        success: function (layero) {
                            content.removeClass("hidden")
    
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