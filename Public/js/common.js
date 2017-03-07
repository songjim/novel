$(function () {
    var commonFunc = function () {
        this.init();
    };

    commonFunc.prototype = {
        init: function () {
            var that = this;

            that.initHtml();
            that.initScroll();
            that.scrollEvent();
            that.initEditor();
            that.initSaveHead();
            that.bindEvents();
        },

        // 事件绑定
        bindEvents: function () {
            var that = this;
            var $body = $('body');

            $body.on('click', '#login-btn', $.proxy(that.showPCLogin, that))
                .on('click', '#close', $.proxy(that.cancelLogin, that))
                .on('click', '.btnLogin', $.proxy(that.goLogin, that))
                .on('click', '.J-go-top', $.proxy(that.goTop, that)) // 回到顶部按钮
                .on('click', '.theme_nav_list', $.proxy(that.changeTag, that))
                .on('click', '#sendCodeBtn', $.proxy(that.sendCode, that))
                .on('click', '.J-check-login', $.proxy(that.checkLogin, that))
                .on('click', '.J-change-name', $.proxy(that.changeName, that))
                .on('click', 'button.J-name-input', $.proxy(that.saveName, that))
                .on('click', '.J-change-avatar', $.proxy(that.changeAvatar, that))
                .on('click', '.J-add-note', $.proxy(that.addNote, that))
                .on('click', '.J-del-confirm', $.proxy(that.delConfirm, that))
        },

        /**
         * 实例化编辑器
         */
        initEditor: function () {
            try {
                var um = UM.getEditor('myEditor');
                um.addListener('blur',function(){
                    $('#focush2').html('编辑器失去焦点了')
                });
                um.addListener('focus',function(){
                    $('#focush2').html('')
                });
            } catch (err) {

            }
        },

        /**
         * 删除确认
         */
        delConfirm: function () {
            var flag = confirm('请确定是否删除');

            if (!flag) {
                return false;
            }
        },

        /**
         * 发新帖
         */
        addNote: function () {
            var that = this;
            that.checkLogin();

            var h = $(document).height()-$(window).height();
            $(document).scrollTop(h);
        },

        /**
         * 展示修改头像框
         */
        changeAvatar: function () {
            $('.portrai-shade').show();
        },

        /**
         * 修改昵称
         */
        changeName: function () {
            var name = $('.J-username-text').text().trim();
            $('input.J-name-input').val(name);
            $('.J-name-input').show();
            $('.J-username-text').hide();
        },

        /**
         * 初始化上传头像
         */
        initSaveHead: function () {
            var options =
                {
                    thumbBox: '.thumbBox',
                    spinner: '.spinner',
                    imgSrc: 'images/avatar.png'
                }

                try {
                    var cropper = $('.imageBox').cropbox(options);
                } catch (err) {
                    return false;
                }

            $('#upload-file').on('change', function(){
                var reader = new FileReader();
                reader.onload = function(e) {
                    options.imgSrc = e.target.result;
                    cropper = $('.imageBox').cropbox(options);
                }
                reader.readAsDataURL(this.files[0]);
                this.files = [];
            })
            $('#btnCrop').on('click', function(){
                try {
                    var img = cropper.getDataURL();
                    $('.cropped').html('');
                    $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:64px;margin-top:4px;border-radius:64px;box-shadow:0px 0px 12px #7E7E7E;" ><p>64px*64px</p>');
                    $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:128px;margin-top:4px;border-radius:128px;box-shadow:0px 0px 12px #7E7E7E;"><p>128px*128px</p>');
                    $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:180px;margin-top:4px;border-radius:180px;box-shadow:0px 0px 12px #7E7E7E;"><p>180px*180px</p>');
                    $('#J-save-head-img').show();
                } catch (e) {

                }
            })
            $('#btnZoomIn').on('click', function(){
                cropper.zoomIn();
            })
            $('#btnZoomOut').on('click', function(){
                cropper.zoomOut();
            })
            $('#J-save-head-img').on('click', function(){

                try {
                    var img = cropper.getDataURL();
                    $.ajax({
                        url: 'index.php?m=Home&c=Forums&a=personImg',
                        type: 'post',
                        data: {
                            img: img
                        },
                        success: function(data) {
                            if (data) {
                                location.reload(true);
                            }
                        }
                    })
                } catch (err) {
                    $('.portrai-shade').hide();
                }
            })
        },

        /**
         * 保存昵称
         */
        saveName: function () {
            var name = $('input.J-name-input').val().trim();

            if (name) {

                $.ajax({
                    url: 'index.php?m=Home&c=Forums&a=userNameUp',
                    type: 'post',
                    data: {
                        name: name
                    },
                    success: function (data) {
                        if (data) {
                            $('.J-username-text').text(name);
                            $('.J-name-input').hide();
                            $('.J-username-text').show();
                        }
                    }
                });
            } else {
                $('.J-name-input').hide();
                $('.J-username-text').show();
            }
        },

        // 页面初始化
        initHtml: function () {
            var that = this;
            var signIn = $('.sign-in').length;
            if (signIn) {
                that.getNotice();

                setInterval(function () {
                    that.getNotice();
                }, 30000);
            }
        },

        /**
         * 检查是否登录
         */
        checkLogin: function () {
            var that = this;
            var signIn = $('.sign-in').length;

            if (!signIn) {
                $('#login-btn').trigger('click');
                return false;
            }
        },

        /**
         * 初始化首页轮播
         */
        initScroll: function () {
            var demo = $('#demo1');

            if (demo.length) {
                demo.bxCarousel({
                    display_num: 4,
                    move: 1,
                    auto: true,
                    controls: false,
                    margin: 10,
                    auto_hover: true,
                    // speed: 3000,
                    auto_interval: 3000
                });
            }
        },

        /**
         * 消息请求方法
         */
        getNotice: function () {
            $.ajax({
                url: '/index.php?m=Home&c=Forums&a=messageNum',
                type: 'get',
                dataType: 'json',
                success: function (res) {

                    if (res.success) {
                        var num = res.data.count || 0;
                        $('#msg-btn').find('i').text(num);
                    } else {
                        console.log(res.message);
                    }
                }
            })
        },

        /**
         * 公告滚动事件
         */
        scrollEvent: function () {
            if ($('.J-anno-box').length) {
                $('.J-anno-box').myScroll({
                    speed: 90, //数值越大，速度越慢
                    rowHeight: 36 //li的高度
                });
            }

        },
        /**
         * 回到顶部
         */
        goTop: function () {
            $("body,html").animate({
                scrollTop: 0
            });
        },

        /**
         * 发送验证码
         */
        sendCode: function () {
            var mail = $('#txtemail').val().trim();

            if (mail) {
                $.ajax({
                    url: '/index.php?m=Home&c=Register&a=sendCodeEmail',
                    type: 'post',
                    data: {
                        mail: mail
                    },
                    success: function (res) {
                        $('#sendCodeBtn').val('已发送');
                        $('#sendCodeBtn').attr('disabled', 'disabled');
                    }
                })
            };
        },

        // 登录方法
        showPCLogin: function () {
            var $body = $("body");

            if ($(".mask")) {
                $(".mask").remove()
            }
            $('.qdlogin-wrap').show();
            $body.append('<div class="mask"></div>');
        },

        // 取消登录
        cancelLogin: function () {
            $(".mask").remove();
            $('.qdlogin-wrap').hide();
        },

        // 提交登录信息
        goLogin: function(e) {
            e.stopPropagation();
            var curTarget = $(e.currentTarget);
            var form = curTarget.parents('#j_loginSwitchWrap');
            $.ajax({
                url: '/index.php?m=Home&c=Login&a=login',
                type: 'post',
                data: {
                    email: form.find('input#email').val().trim(),
                    password: form.find('input#password').val().trim()
                },
                success: function(data) {
                    var r_data = JSON.parse(data);
                    if (r_data && r_data.success) {
                        location.href = r_data.url
                    } else {
                        $('.J-error-box').html('用户名或密码输入错误').removeClass('hidden');
                    }
                }
            })
        },

        // 切换
        changeTag: function (e) {
            e.stopPropagation();
            var curTarget = $(e.currentTarget);
            var index = (curTarget.index()) / 2;

            $('.theme_nav_list').removeClass('current');
            $('.theme_con_index').removeClass('current');
            $('.theme_nav_list').eq(index).addClass('current');
            $('.theme_con_index').eq(index).addClass('current');
        }
    }

    var cf = new commonFunc();
})