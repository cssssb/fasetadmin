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
        invite:function(){
            $(document).on("click", ".copy", function () {
                var copyDom = document.querySelector('#link');
                //创建选中范围
            var range = document.createRange();
            range.selectNode(copyDom);
                //移除剪切板中内容
            window.getSelection().removeAllRanges();
                //添加新的内容到剪切板
            window.getSelection().addRange(range);
                //复制
            var successful = document.execCommand('copy');
             return successful
            });

        
        },
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
                            layer.msg("查询不到此账号")
                            return;
                        }
                        var optionsItem = document.createElement("tr");
                        var tab = "<td>" + ret.data.has_pwd + "</td><td>" + ret.data.price + "</td><td>" + ret.data.number + "</td><td> </td></td><td class='passduihuan'>兑换</td>";
                        optionsItem.innerHTML = tab;
                        var tabbox = document.querySelector("#tabbox")
                        console.log(tabbox)
                        tabbox.appendChild(optionsItem);
                        $("#cardpass").val() == "";
                    },
                    error: function (e) {

                    }
                });

            });
            //   点的按钮
            $(document).on("click", ".passduihuan", function () {
                console.log($(this).parent().children("td:first-child").text())
                var pass = $(this).parent().children("td:first-child").text()
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
        mainaccountnumber: function () {
            // 点击查询
            $(document).on("click", ".blacksearch", function () {
                var passid = $("#ipaddress").val();
                var content
                if (passid == "") {
                    content = "输入账号不能为空"
                } else {
                    $.ajax({
                        url: "/index/user/blacklistedQuery",
                        type: 'get',
                        dataType: 'json',
                        data: {
                            ip: passid
                        },
                        success: function (ret) {
                            if (ret.message == "success" && ret.data.searchList) {
                                var res = ret.data.searchList
                                content = "<div>ip:" + res.remote_ip + "</div><div>创建时间：" + res.create_time + "</div><div>名称:" + res.acc + "</div><div>屏蔽时长:" + res.lot + "</div><div>原因:" + res.message + "</div>"

                            }
                        },
                        error: function (e) {

                        }
                    });
                    Layer.open({
                        type: 1,
                        title: '信息',
                        area: ["300px", "200px"],
                        content: content,
                        skin: 'demo-class',
                        success: function (layero) {

                        }
                    });
                }
            });
            // 点击解除
            $(document).on("click", ".blackjiechu", function () {
                var passid = $("#ipaddress").val();
                var content
                if (passid == "") {
                    content = "输入账号不能为空"
                } else {
                    $.ajax({
                        url: "/index/user/deleteBlack",
                        type: 'get',
                        dataType: 'json',
                        data: {
                            ip: passid
                        },
                        success: function (ret) {
                            if (ret.message == "success" && ret.data.searchList) {
                                var res = ret.data.searchList
                                content = "<div>ip:" + res.remote_ip + "解除成功</div><div>请立马解决触发原因</div><div>否则会再次发生屏蔽</div>";

                            }
                        },
                        error: function (e) {

                        }
                    });
                }
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

        },
        // 申请动态
        dynamic: function () {

            $(".onlyNumAlpha").bind("input propertychange change", function (event) {
                var num = $(".onlyNumAlpha").val();
                var reg = /^[0-9a-zA-Z]+$/;
                if (!reg.test(num)) {
                    layer.msg("只能输入数字或者字母");
                    $(this).val("")
                }
            });

            $(".onlynum").bind("input propertychange change", function (event) {
                var num = $(".onlynum").val();
                if (num <= 0) {
                    layer.msg("数量至少为1");
                    $(".onlynum").val(1)
                }
            });
            // 申请动态的城市列表
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
            // 创建动态账号
            $(document).on("click", ".dynamicbtn", function () {

                var str = $(".onlyNumAlpha").val();
                var num = $(".onlynum").val();
                var reg = /^[0-9a-zA-Z]+$/;
                if (!reg.test(str) || num <= 0) {
                    layer.msg("请输入正确信息");
                    return;
                }
                var param = {
                    'name': $('[name=name]').val(),
                    'password': $('[name= password]').val(),
                    'accountTotal': $('[name=accountTotal]').val(),
                    'defaultLink': $('[name=defaultLink]').val(),
                    'isp': $('[name= isp]:checked').val(),
                    'count': $('[name=count]').val(),
                    'serve_id': $('[name=serve_id]').val(),
                    'timeoutExec': $('[name=timeoutExec]:checked').val(),
                    'linkId': 9999
                }

                $.ajax({
                    url: "/index/user/agentCreate",
                    type: 'get',
                    dataType: 'json',
                    data: param,
                    success: function (ret) {
                        if(ret.msg){
                            layer.msg(ret.msg);
                        }else{
                        switch (ret.code) {
                            case 0:
                                Toastr.success("申请成功");
                                // setTimeout(() => {
                                //     window.location.reload()
                                // }, 1000);
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
                            case 7 || 7:
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
                    }

                    },
                    error: function (e) {}
                });

            });

        },

        dynamiclist: function () {
            var linklist = [];
            $.ajax({
                url: "/index/user/lineList",
                type: 'get',
                dataType: 'json',
                data: {},
                success: function (ret) {
                    linklist = ret.data.linkList;
                },
                error: function (e) {}
            });

            var pageIndex = 1;
            var countpages
            var serverid=2;
            var id;
            //AJAX方法取得数据并显示到页面上 
            BindData();

            function BindData() {
                $.ajax({
                    type: "get", //使用get方法访问后台 
                    dataType: "json", //返回json格式的数据 
                    url: "/index/user/agentSearchAccByCid", //要访问的后台地址 
                    data: {
                        "page": pageIndex,
                        'serve_id': serverid
                    }, //要发送的数据 
                    ajaxStart: function () {
                        $("#loding").show();
                    },
                    complete: function () {
                        $("#loding").hide();
                    }, //AJAX请求完成时隐藏loading提示 
                    success: function (msg) { //msg为返回的数据，在这里做数据绑定 

                        if (msg.code == 0) {
                            var data = msg.data;

                            var end = data.cur_page * 50;
                            var start = end - 49;
                            countpages = data.pages;
                            $(".count").text(data.count);
                            $(".start").text(start);
                            $(".end").text(end);
                            $(".page-number").remove()
                            $(".tabcontent").remove()
                            for (var i = 1; i <= data.pages; i++) {
                                $("#next").before("<li class='page-number'><a href='#'>" + i + "</a></li>")
                                $(".page-number").eq(data.cur_page - 1).addClass("active");
                                $(".active").children("a").addClass("activea")
                            };
                            $.each(data.accList, function (i, item) {
                                var link;
                                var linkname
                                $.each(item.linkList, function (index, it) {
                                    if (it.isDefault == 1) {
                                        link = it.linkId
                                    }
                                })
                                setTimeout(() => {
                                    $.each(linklist, function (key, data) {
                                        if (data.id == link) {
                                            linkname = data.name;
                                        }
                                    })


                                    // 城市列表

                                    if (item.accType == "dynamic") {
                                        var timeoutExec = (item.timeoutExec == 'add' ? '增加' : '断开');
                                        var isOnline = (item.isOnline == 1 ? '在线' : '离线');
                                        var isp
                                        switch (item.isp) {
                                            case 0:
                                                isp = "不限";
                                                break;
                                            case 1:
                                                isp = "联通";
                                                break;
                                            case 2:
                                                isp = "电信";
                                                break;
                                            case 3:
                                                isp = "移动";
                                                break;


                                        }
                                        var content = "<tr style='text-align: center; vertical-align: middle;' class='tabcontent'><td><input type='checkbox' name='checkone' id='checkone' ></td><td>" +
                                            item.username + " </td><td>" + item.expireTime +
                                            " </td><td>" + isp + " </td><td>" + linkname + " </td><td>" + timeoutExec + " </td><td><span style='background: #2c3e50;color: #fff;padding: 2px 8px;border-radius:5px'>" + item.surplus +
                                            "</span> </td><td><span class='text-danger'><i class='fa fa-circle'></i>" + isOnline +
                                            " </td> <td class='bianji'  id='" + item.id + "'><a class='btn btn-xs btn-success btn-editone' data-original-title='编辑'><i class='fa fa-pencil'></i></a> </td></tr>"
                                        $(".table-nowrap").append(content)
                                    } else {
                                        $(".fixed-table-body").html("<div style='padding:50px; text-align: center;width:100%'>暂无数据</div>")
                                    }
                                }, 1000);
                            })

                        }
                    },
                    error: function () {
                        alert("加载数据失败");
                    } //加载失败，请求错误处理 
                });
            };
            //上一页按钮click事件 
            $("#previous").click(function () {
                if (pageIndex != 1) {
                    pageIndex--;
                    $("#lblCurent").text(pageIndex);
                }
                BindData();
            });
            //下一页按钮click事件 
            $("#next").click(function () {
                var pageCount = $(".page-number").index(".active");
                if (pageCount >= countpages) {
                    return;
                }
                if (pageIndex != pageCount) {
                    pageIndex++;
                }
                BindData();
            });
            $("#checkall").click(function () {
                $(":checkbox[name='checkone']").prop("checked", this.checked); // this指代的你当前选择的这个元素的JS对象
            });



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
                            optionsItem.value = e.id;

                            var selectpicker = document.querySelector(".selectpicker")
                            selectpicker.appendChild(optionsItem);
                        })

                    },
                    error: function (e) {

                    }
                });
                // console.log($(this).parent().children().eq(2).text())
                $(".xiuname").val($(this).parent().children().eq(1).text());
                Layer.open({
                    type: 1,
                    title: '信息',
                    area: ["650px", "450px"],
                    content: $(".propfrom"),
                    skin: 'demo-class',
                    success: function (layero) {
                        $(".propfrom").removeClass("hidden")

                    }
                });
                id = $(this).attr("id");



            });
            $(document).on("click", ".gouxuan", function () {
                // var target = $(this).attr("class")
                var content
                var s
                content = $(".checkedcontent");
                $('input[name="checkone"]:checked').each(function () {
                    console.log($(this).parent().next().text())

                    s += $(this).parent().next().text() + ', ';

                });
                $("#c-vcname").val(s.substring(9));
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

            $(".connum").bind("input propertychange change", function (event) {
                var num = $(".connum").val();
                document.querySelector("#code").innerText = 10 * num
            });

            $(".staticgroup").click(function () {
                if ($(".changedy").text() == "切换至e服务器动态列表") {
                    $(".changedy").text("切换至b服务器动态列表");
                    $(".titname").text("e服务器动态列表")
                    serverid = 1;
                    BindData()
                } else if ($(".changedy").text() == "切换至b服务器动态列表") {
                    $(".changedy").text("切换至e服务器动态列表")
                    $(".titname").text("b服务器动态列表")

                    serverid = 2;
                    BindData()
                }
                // BindData();
            });
            $(".checkbtn").click(function () {
                if ($(".connum").val().trim() == "") {
                    layer.msg("请输入充值天数")
                }
                $.ajax({
                    url: "/index/user/agentRecharge",
                    type: 'get',
                    dataType: 'json',
                    data: {
                        "name": $("#c-vcname").val(),
                        "count": $(".connum").val(),
                        'serve_id': serverid
                    },
                    success: function (ret) {
                        switch (ret.code) {
                            case 0:
                                Toastr.success("修改成功");
                                // setTimeout(() => {
                                //     window.location.reload()
                                // }, 1000);
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
                            case 6 :
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
                            case 7:
                                layer.msg("账号名重复");
                        }

                    },
                    error: function (e) {

                    }
                });
            });

            // 编辑请求
            $(document).on("click", ".xiugaibtn", function () {

                // var num = $(".onlyNumAlpha").val();
                // var reg = /^[0-9a-zA-Z]+$/;
                // if(!reg.test(num)){
                //     layer.msg("只能输入数字或者字母");
                //    return;
                //     }
                var param = {
                    "id": id,
                    'password': $('[name= password]').val(),
                    'isp': $('[name= isp]:checked').val(),
                    'count': $('[name=count]').val(),
                    'serve_id': $('[name=serve_id]').val(),
                    'timeoutExec': $('[name=timeoutExec]:checked').val(),
                    'status': $('[name=status]:checked').val()
                }
                var params = {
                    "id": id,
                    'linkId': 9999,
                    "defaultLink": $('[name=defaultLink]').val(),
                    'status': $('[name=status]:checked').val(),
                    "updateIp": 1
                }
                $.ajax({
                    url: "/index/user/agentChangeAccEnableLinks",
                    type: 'get',
                    dataType: 'json',
                    data: params,
                    success: function (ret) {
                        switch (ret.code) {
                            case 0:
                                Toastr.success("修改成功");
                                // setTimeout(() => {
                                //     window.location.reload()
                                // }, 1000);
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
                            case 7 || 7:
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


                    },
                    error: function (e) {}
                });

                $.ajax({
                    url: "/index/user/agentChangeAccBaseDatal",
                    type: 'get',
                    dataType: 'json',
                    data: param,
                    success: function (ret) {
                        switch (ret.code) {
                            case 0:
                                Toastr.success("修改成功");
                                // setTimeout(() => {
                                //     window.location.reload()
                                // }, 1000);
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
                            case 6 || 7:
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


                    },
                    error: function (e) {}
                });

            });


        },
        // 申请静态
        static: function () {
            $(".onlyNumAlpha").bind("input propertychange change", function (event) {
                var num = $(".onlyNumAlpha").val();
                var reg = /^[0-9a-zA-Z]+$/;
                if (!reg.test(num)) {
                    layer.msg("只能输入数字或者字母");
                    $(this).val("")
                }
            });
            $(".onlynum").bind("input propertychange change", function (event) {
                var num = $(".onlynum").val();
                if (num <= 0) {
                    layer.msg("数量至少为1");
                    $(".onlynum").val(1)
                }
            });
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

                // var str = $(".onlyNumAlpha").val();
                // var num = $(".onlynum").val();
                // var reg = /^[0-9a-zA-Z]+$/;
                // if(!reg.test(str) || num<=0){
                //     layer.msg("请输入正确信息");
                //   return;
                //     }
                var param = {
                    'name': $('[name=name]').val(),
                    'password': $('[name= password]').val(),
                    'accountTotal': $('[name=accountTotal]').val(),
                    'defaultLink': $('[name=defaultLink]').val(),
                    "expireDate": $('[name=expireDate]').val(),
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
                        if(ret.msg){
                            layer.msg(ret.msg);
                        }else{
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
                            case 7 || 7:
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
            var linklist = [];
            $.ajax({
                url: "/index/user/lineList",
                type: 'get',
                dataType: 'json',
                data: {},
                success: function (ret) {
                    linklist = ret.data.linkList;
                },
                error: function (e) {}
            });

            var pageIndex = 1;
            var countpages
            var serverid
            //AJAX方法取得数据并显示到页面上 
            BindData();

            function BindData() {
                $.ajax({
                    type: "get", //使用get方法访问后台 
                    dataType: "json", //返回json格式的数据 
                    url: "/index/user/agentSearchAccByCid", //要访问的后台地址 
                    data: {
                        "page": pageIndex,
                        'serve_id': serverid
                    }, //要发送的数据 
                    ajaxStart: function () {
                        $("#loding").show();
                    },
                    complete: function () {
                        $("#loding").hide();
                    }, //AJAX请求完成时隐藏loading提示 
                    success: function (msg) { //msg为返回的数据，在这里做数据绑定 
                        if (msg.code == 0) {

                            var data = msg.data;

                            var end = data.cur_page * 50;
                            var start = end - 49;
                            countpages = data.pages;
                            $(".count").text(data.count);
                            $(".start").text(start);
                            $(".end").text(end);
                            $(".page-number").remove()
                            $(".tabcontent").remove()
                            for (var i = 1; i <= data.pages; i++) {
                                $("#next").before("<li class='page-number'><a href='#'>" + i + "</a></li>")
                                $(".page-number").eq(data.cur_page - 1).addClass("active");
                                $(".active").children("a").addClass("activea")
                            };
                            $.each(data.accList, function (i, item) {
                                var link;
                                var linkname
                                $.each(item.linkList, function (index, it) {
                                    if (it.isDefault == 1) {
                                        link = it.linkId
                                    }
                                })
                                setTimeout(() => {
                                    $.each(linklist, function (key, data) {
                                        if (data.id == link) {
                                            linkname = data.name;
                                        }
                                    })

                                if (data.accType == "static") {
                                    var timeoutExec = (item.timeoutExec == 'add' ? '增加' : '断开');
                                    var isOnline = (item.isOnline == 1 ? '在线' : '离线');
                                    var isp
                                    switch (item.isp) {
                                        case 0:
                                            isp = "不限";
                                            break;
                                        case 1:
                                            isp = "联通";
                                            break;
                                        case 2:
                                            isp = "电信";
                                            break;
                                        case 3:
                                            isp = "移动";
                                            break;


                                    }
                                    var content = "<tr style='text-align: center; vertical-align: middle;' class='tabcontent'><td><input type='checkbox' name='checkone' id='checkone'></td><td>" +
                                        item.username + " </td><td>" + item.groupId +
                                        " </td><td>" + item.expireTime + " </td><td>" + isp + " </td><td>" + linkname + " </td><td><span class='text-danger'><i class='fa fa-circle'></i>" + isOnline +
                                        " </td> <td class='bianji'><a class='btn btn-xs btn-success btn-editone' data-original-title='编辑'><i class='fa fa-pencil'></i></a> </td></tr>"
                                    $(".table-nowrap").append(content)
                                } else {
                                    $(".fixed-table-body").html("<div style='padding:50px; text-align: center;width:100%;font-size:14px'>暂无数据</div>")
                                }
                            })
                            })

                        }
                    },
                    error: function () {
                        alert("加载数据失败");
                    } //加载失败，请求错误处理 
                });
            };
            //上一页按钮click事件 
            $("#previous").click(function () {
                if (pageIndex != 1) {
                    pageIndex--;
                    $("#lblCurent").text(pageIndex);
                }
                BindData();
            });
            //下一页按钮click事件 
            $("#next").click(function () {
                var pageCount = $(".page-number").index(".active");
                if (pageCount >= countpages) {
                    return;
                }
                if (pageIndex != pageCount) {
                    pageIndex++;
                }
                BindData();
            });
            $("#checkall").click(function () {
                $(":checkbox[name='checkone']").prop("checked", this.checked); // this指代的你当前选择的这个元素的JS对象
            });


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
                $(".xiuname").val($(this).parent().children().eq(1).text());

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

            $(document).on("click", ".gouxuan", function () {
                // var target = $(this).attr("class")
                var content
                var s
                content = $(".checkedcontent");
                $('input[name="checkone"]:checked').each(function () {
                    console.log($(this).parent().next().text())

                    s += $(this).parent().next().text() + ', ';

                });
                if ($("#c-vcname").val() != "") {
                    $("#c-vcname").val(s.substring(9));


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
                } else {
                    return;
                }
            });

            $(".checkbtn").click(function () {
                if ($(".connum").val().trim() == "") {
                    layer.msg("请输入充值天数")
                }
                $.ajax({
                    url: "/index/user/agentRecharge",
                    type: 'get',
                    dataType: 'json',
                    data: {
                        "name": $("#c-vcname").val(),
                        "days": $(".connum").val(),
                        'serve_id': 3
                    },
                    success: function (ret) {
                        switch (ret.code) {
                            case 0:
                                Toastr.success("申请成功");
                                // setTimeout(() => {
                                //     window.location.reload()
                                // }, 1000);
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
                            case 7 :
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
                            case 6:
                                layer.msg("账号名重复");
                        }



                    },
                    error: function (e) {

                    }
                });
            });
            $(document).on("click", ".xiugaibtn", function () {

                var num = $(".onlyNumAlpha").val();
                var reg = /^[0-9a-zA-Z]+$/;
                if (!reg.test(num)) {
                    layer.msg("只能输入数字或者字母");
                    return;
                }
                var param = {
                    "id": id,
                    'password': $('[name= password]').val(),
                    'isp': $('[name= isp]:checked').val(),
                    'count': $('[name=count]').val(),
                    'serve_id': $('[name=serve_id]').val(),
                    'timeoutExec': $('[name=timeoutExec]:checked').val(),
                    'status': $('[name=status]:checked').val()
                }
                var params = {
                    "id": id,
                    'linkId': 9999,
                    "defaultLink": $('[name=defaultLink]').val(),
                    'status': $('[name=status]:checked').val(),
                    "updateIp": 1
                }
                $.ajax({
                    url: "/index/user/agentChangeAccEnableLinks",
                    type: 'get',
                    dataType: 'json',
                    data: params,
                    success: function (ret) {
                        switch (ret.code) {
                            case 0:
                                Toastr.success("申请成功");
                                // setTimeout(() => {
                                //     window.location.reload()
                                // }, 1000);
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
                            case 7 || 7:
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


                    },
                    error: function (e) {}
                });

                $.ajax({
                    url: "/index/user/agentChangeAccBaseDatal",
                    type: 'get',
                    dataType: 'json',
                    data: param,
                    success: function (ret) {
                        switch (ret.code) {
                            case 0:
                                Toastr.success("申请成功");
                                // setTimeout(() => {
                                //     window.location.reload()
                                // }, 1000);
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
                            case 7 || 7:
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


                    },
                    error: function (e) {}
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