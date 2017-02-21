function QRegister(config) {

    this.config = {
        appId: '10',
        areaId: 1,
        format: 'jsonp',
        backUrl: '',
        apiUrl: '',
        loginUrl: '/login.html'
    };

    if (config) this.config = config;

    this.tips = {
        phoneEmpty: '请输入手机号码',
        phoneInvalid: '请输入有效的手机号码',
        phoneExist: '该手机号已注册，请尝试直接 <a class="blue" href="' + this.config.loginUrl + '">登录</a>',
        captchaEmpty: '验证码不能为空',
        captchaError: '验证码错误',
        sendLoading: '发送中...',
        sendDefault: '获取验证码',
        reSendMsg: '重新发送',
        sendMsgError: '发送失败，请重新尝试',
        phoneCodeError: '手机验证码不正确',
        confirmPwdEmpty: '请再次输入密码',
        pwdNotSame: '您两次输入的密码不一致',
        emailEmpty: '请输入邮箱',
        emailInvalid: '请输入正确的邮箱',
        emailNotSupport: '邮箱后辍不支持',
        emailExist: '该邮箱账号已注册，请尝试直接 <a class="blue" href="' + this.config.loginUrl + '">登录</a>'
    };

    this.checkAccount = false;
    this.sessionKey = '';
    this.needValidateCode = true;
    this.sendCodeTimeout = '';
    this.requestID = '';
    this.time = Math.round(new Date().getTime() / 1000);
    this.isRegistering = false;
    this.isChecking = false;
    this.force = 0;

    //屏蔽国外的邮箱
    this.forbidEmails = ['chacuo.net', '027168.com', 'sharklasers.com', 'grr.la', 'guerrillamail.biz',
        'guerrillamail.com', 'guerrillamail.de', 'guerrillamail.net', 'guerrillamail.org',
        'guerrillamailblock.com', 'spam4.me', 'yopmail.fr', 'yopmail.net', 'yopmail.com',
        'cool.fr.nf', 'jetable.fr.nf', 'nospam.ze.tc', 'nomail.xl.cx', 'mega.zik.dj', 'speed.1s.fr',
        'courriel.fr.nf', 'moncourrier.fr.nf', 'monemail.fr.nf', 'monmail.fr.nf', 'meltmail.com',
        'mailinator.com', 'anonymbox.com'];
    this.hasShowCaptcha = false;

    this.phoneInterval = function () {
        var that = this;
        var count = $.cookie('phone_interval') > 0 ? $.cookie('phone_interval') : 59;
        var interval = setInterval(function () {
            count--;
            $.cookie('phone_interval', count, {expires: count / (7 * 24 * 60 * 60)});
            if (count <= 0) {
                clearInterval(interval);
                $("#txtphoneimgcode").val('');
                that.showCaptcha();
                that.closeSendLoading();
            }
            else {
                $("#get_code").html("(" + count + ")" + that.tips.reSendMsg);
            }
        }, 1000);
    };

    this.init = function () {
        var that = this;
        $("#txtphonenumber").blur(function () {
            that.checkPhoneNumber();
        });
        $("#txtphonenumber").focus(function () {
            that.hideError('phone');
        });
        $("#get_code").click(function () {
            that.sendCode();
        });
        $("#refresh_code").click(function () {
            that.refreshCode();
        });
        $("#txtphoneimgcode").focus(function () {
            that.hideError('imgphonernd_code');
        });
        $("#txtphoneimgcode").blur(function () {
            that.checkImageCode('txtphoneimgcode', 'imgphonernd_code');
        });

        $("#txtphonecode").focus(function () {
            that.hideError('phonecode');
        });
        $("#txtphonecode").blur(function () {
            that.checkCode();
        });

        $("#txtphonepwd").focus(function () {
            that.showPswError('txtphonepwd');
        });
        $("#txtphonepwd").blur(function () {
            that.checkPassword('txtphonepwd');
        });
        $("#txtphonepwd").keyup(function () {
            that.showPswError('txtphonepwd');
        });

        $("#txtphonepwd2").focus(function () {
            that.hideError('password2');
        });
        $("#txtphonepwd2").blur(function () {
            that.checkPassword2();
        });

        $("#txtemail").focus(function () {
            that.hideError('email_dd');
        });
        $("#txtemail").blur(function () {
            that.checkEmail();
        });

        $("#btnPhoneRegister").click(function () {
            that.doRegister();
        });

        $("#btnMailRegister").click(function () {
            that.doRegisterByEmail();
        });

        $('.deal').click(function () {
            if ($('#deal').is(':checked') != true) {
                $(".red-btn").addClass('disabled');
            }
            else {
                $(".red-btn").removeClass('disabled');
            }
        });
    };


    this.checkPhoneNumber = function () {
        // 检查手机号码z
        var phonearea = $('.ui-select-text').text();
        var phone = $('#txtphonenumber').val();
        var accountType = 101; //中国大陆

        phone = phone.replace(/[ ]/g, "");
        phone = $.trim(phone);

        var areano = $('.ui-select-text').text().split('+');
        if (areano.length == 2) areano = $.trim(areano[1]);

        if (phone == 'undefined' || phone.length == 0) {
            this.showError('phone', this.tips.phoneEmpty);
            return;
        }

        if (phonearea.indexOf('+86') > 0) {
            var phoneIsAboard = false;
            var re = /^(13[0-9]|15[0-9]|18[0-9]|145|147|17[0-9])\d{8}$/;
            if (re.test(phone) != true) {
                this.showError('phone', this.tips.phoneInvalid)
                return;
            }

        }
        else {
            var re = /^\d+$/;
            var phoneIsAboard = true;
            if (re.test(phone) != true) {
                this.showError('phone', this.tips.phoneInvalid)
                return;
            }
            phone = '+' + areano + phone;
            accountType = 105; //海外
        }

        var that = this;
        this.isChecking = true;

        this.showPassTip('phone');

        return;
    };

    this.checkEmailForbid = function () {
        var checkresulet = false;
        var name = $("#txtemail").val();
        var idx = name.indexOf('@');
        if (idx != -1) {
            var idxname = $.trim(name.substr(idx + 1));//获取邮箱后缀
            for (var i = 0; i < this.forbidEmails.length; i++) {
                if (idxname == this.forbidEmails[i]) {
                    checkresulet = true;
                    break;
                }
            }
        }
        return checkresulet;
    };

    this.checkEmail = function () {
        var showid = 'email_dd';
        var name = $("#txtemail").val();
        name = $.trim(name);
        if (name == null || name.length <= 0) {
            this.showError(showid, this.tips.emailEmpty);
            return false;
        }
        var re = new RegExp(/^(\w)+([-.]\w+)*@[\w-]+(\.[\w-]+)+$/);
        if (!re.test(name)) {
            this.showError(showid, this.tips.emailInvalid);
            return false;
        }

        re = new RegExp(/^(\w)+([-.]\w+)*@[((\w)+\.)]+(com|net|cn|org)$/);
        if (!re.test(name.toLowerCase())) {
            this.showError(showid, this.tips.emailNotSupport);
            return false;
        }

        if (this.checkEmailForbid()) {
            this.showError(showid, this.tips.emailNotSupport);
            return false;
        }
        this.showPassTip(showid);
        var that = this;
        // this.authApi.checkAccount(name, 102, function(result){
        // 	if(result.data.existing == true) {
        // 		that.checkAccount = false;
        // 		that.showError(showid, that.tips.emailExist);
        // 		return ;
        // 	}

        // 	if(result.data.existing == false ) that.checkAccount = true;

        // 	that.showPassTip(showid);
        // });
    };

    this.showCaptcha = function (id) {
        var that = this;
        if (!id) id = 'imgphonernd';
    };

    this.showMailCaptcha = function () {
        var that = this;
        this.showCaptcha('imgmailrnd');
    };

    this.refreshCode = function (id) {
        if (!id) id = "imgphonernd";
        var curTime = Math.round(new Date().getTime() / 1000);
        if (curTime - this.time > 30) {
            this.showCaptcha(id);
            this.time = curTime;
            return;
        }

        this.time = curTime;

        var url = $("#" + id).attr("src");

        if (url != "" && url != "images/code.png") {
            if (url.indexOf("&rnd=") > -1) {
                url = url.substr(0, url.indexOf("&rnd=")) + "&rnd=" + Math.random();
            }
            else {
                url = url + "&rnd=" + Math.random();
            }
        }

        $("#" + id).attr("src", url);
    };

    this.checkCode = function () {
        var code = $('#txtphonecode').val();
        if (this.requestID == '') {
            this.showError('phonecode', this.tips.phoneCodeError);
            return false;
        }

        if (code.length == 0) {
            this.showError('phonecode', this.tips.phoneCodeError);
            return false;
        }

        var re = /^[0-9]{4,}$/;
        if (re.test(code) != true) {
            this.showError('phonecode', this.tips.phoneCodeError);
            return false;
        }
        this.showPassTip('phonecode');
        return true;
    };

    //验证图片验证码
    this.checkImageCode = function (txtid, showid) {

        if (!this.needValidateCode) return true;

        var code = $('#' + txtid).val();
        if (code.length == 0) {
            this.showError(showid, this.tips.captchaEmpty);
            return false;
        }

        return true;
    };


    this.sendCode = function () {
        //检查是否达到时间间隔
        var count = $.cookie('phone_interval') > 0 ? $.cookie('phone_interval') : 59;
        if (count > 0 && count < 59) return;

        var that = this;
        if (this.checkAccount != true && !this.isChecking) {
            this.checkPhoneNumber();
            console.log('check phone number error');
            return;
        }
        if (this.checkAccount != true && this.isChecking) {
            setTimeout(function () {
                that.sendCode();
            }, 200);
            return;
        }
        ;

        var phone = $("#txtphonenumber").val();
        phone = $.trim(phone);
        var areano = $('.ui-select-text').text().split('+');
        if (areano.length == 2) areano = $.trim(areano[1]);
        else areano = '';
        var phoneIsAbroad = 0;
        if (areano != '86') {
            phone = '+' + areano + phone;
            phoneIsAbroad = 1;
        }

        if (!this.hasShowCaptcha) {
            that.hideError('phonecode');
            this.showCaptcha();
            return;
        }

        var captchaCode = $("#txtphoneimgcode").val();

        if (!this.checkImageCode('txtphoneimgcode', 'imgphonernd_code')) return false;

        this.hideError('phonecode');

        this.sendLoading();

    };

    this.sendLoading = function () {
        var msg = arguments[0] || this.tips.sendLoading;
        $("#get_code").html(msg);
        $("#get_code").attr("disabled", "disabled");

    };

    this.closeSendLoading = function () {
        $("#get_code").html(this.tips.sendDefault);
        $("#get_code").removeAttr("disabled");
    };

    this.showPswError = function (id) {
        var psw = $('#' + id).val();
        $('#phonepwd').removeClass('error');
        var valid = true;
        if (psw != '') {
            var re = /^[0-9]{6,8}$/;
            if (re.test(psw) == true) {
                $('#pwdrule2').addClass('red');
                valid = false
            }
            else {
                $('#pwdrule2').removeClass('red');
            }

            re = /\s/g;
            if (re.test(psw) == true) {
                $('#pwdrule3').addClass('red');
                valid = false
            }
            else {
                $('#pwdrule3').removeClass('red');
            }

            var minlen = 6;
            var maxlen = 18;


            if (psw.length < minlen || psw.length > maxlen) {
                $('#pwdrule1').addClass('red');
                valid = false
            }
            else {
                $('#pwdrule1').removeClass('red');
            }
        } else {
            valid = false
        }

        this.disPwdStrength();

        if (!valid) {
            //$('#phonepwd').addClass('error');
            $(".password-tip").show();
        }
        else {
            $(".password-tip").hide();
            //$('#phonepwd').removeClass('error');
            this.authPasswdNew(id);
        }
    };

    this.checkPassword = function (txtid) {
        var psw = $('#' + txtid).val();
        if (psw == null || psw == 'undefined' || psw.length == 0) {
            this.showPswError(txtid);
            $('#phonepwd').addClass('error');
            return false;
        }
        var re = /^[0-9]{0,8}$/;
        if (re.test(psw) == true) {
            this.showPswError(txtid);
            $('#phonepwd').addClass('error');
            return false;
        }
        else {
            $('#pwdrule2').removeClass('red');
        }
        re = /\s/g;
        if (re.test(psw) == true) {
            this.showPswError(txtid);
            $('#phonepwd').addClass('error');
            return false;
        }

        /*re=/^[a-zA-Z0-9!@#_]+$/;
         if (re.test(psw) != true) {
         this.showPswError(txtid);
         $('#phonepwd').addClass('error');
         return false;
         }*/
        if (psw.length < 6 || psw.length > 18) {
            this.showPswError(txtid);
            $('#phonepwd').addClass('error');
            return false;
        }

        this.authPasswdNew(txtid);
        return true;
    };

    this.checkPassword2 = function () {
        var psw = $('#txtphonepwd').val();
        if (!this.checkPassword('txtphonepwd')) return false;

        var psw2 = $('#txtphonepwd2').val();
        if (psw2.length == 0) {
            this.showError('password2', this.tips.confirmPwdEmpty);
            return false;
        }
        if (psw != psw2) {
            this.showError('password2', this.tips.pwdNotSame);
            return false;
        }
        this.showPassTip('password2');
        return true;
    };

    this.authPasswdNew = function (id) {
        var string = $('#' + id).val();
        var level = 0;
        if (/[a-zA-Z]+/.test(string))
            level += 1;
        if (/[0-9]+/.test(string))
            level += 1;
        if (/(?=[\x21-\x7e]+)[^A-Za-z0-9]/.test(string))
            level += 1;
        this.disPwdStrength();
        $('.password-tip').hide();
        $('.password-strong').show();
        $('.password-strong p:eq(' + (level - 1) + ')').show();
    };

    this.doRegister = function () {
        if (this.isRegistering) return false;
        var phone = $("#txtphonenumber").val();
        var password = $("#txtphonepwd").val();
        var code = $("#txtphonecode").val();
        phone = $.trim(phone);
        phone = phone.replace(/[ ]/g, "");

        var areano = $('.ui-select-text').text().split('+');
        if (areano.length == 2) areano = $.trim(areano[1]);
        else areano = '';

        var phoneIsAbroad = 0;

        if (areano != '86') {
            phone = '+' + areano + phone;
            phoneIsAbroad = 1;
        }

        if (this.checkAccount != true) {
            this.checkPhoneNumber();
            console.log('check phone number error');
            return false;
        }

        if (this.checkPassword('txtphonepwd') != true) {
            console.log('check passswrod error');
            return false;
        }
        if (this.checkPassword2() != true) {
            console.log('check passswrod2 error');
            return false;
        }
        if (this.checkCode() != true) {
            console.log('check code error');
            return false;
        }

        if ($('#deal').is(':checked') != true) {
            console.log('agree error');
            //$(".deal").addClass('error');
            return false;
        }

        this.loading();
        var that = this;
        // this.authApi.doRegisterByPhone(phone, phone, phoneIsAbroad, 101, password, this.requestID, code, this.config.backUrl, function(result){

        // 	if(result && result.code == 0 ) {
        // 		var data = result.data;

        // 		if(that.config.ticket == 1) {
        // 			var params = {
        // 				account: phone,
        //         		ticket: data.ticket,
        //         		autoKey: data.autoLoginSessionKey,
        //         		autoTime: data.autoLoginKeppTime,
        //         		guid: data.ywGuid
        //     		}
        // 		} else {
        // 			var params = {
        // 				account: phone,
        //         		guid: data.ywGuid
        //     		}
        // 		}

        // 		var queryString = '';
        // 		if(that.config.queryString) 
        // 			queryString = '?' + that.config.queryString + '&' + $.param(params);       			
        // 		else
        // 			queryString = '?' + $.param(params);

        // 		location.href = '/success.html' + queryString;

        // 	} else if(result.code == 11007){
        // 		that.showError('phonecode', '短信验证码无效');
        // 	}
        // 	else {
        // 		alert(result.message);
        // 	}
        // 	that.closeLoading();
        // });        

    };

    this.doRegisterByEmail = function () {
        if (this.isRegistering) return false;
        var name = $("#txtemail").val();
        var psw = $("#txtphonepwd").val();
        var code = $("[name='code']").val();
        name = $.trim(name);

        if (this.checkPassword2() != true) return false;

        if ($('#deal').is(':checked') != true) {
            return false;
        }

        this.mailLoading();
        var that = this;

        $.ajax({
            url: 'index.php?m=Home&c=Login&a=register',
            type: 'post',
            data: {
                email: name,
                password: psw,
                code:code
            },
            success: function (data) {
                var r_data = JSON.parse(data)
                if (r_data && r_data.success) {

                    location.href = r_data.url
                }
                return;
            }
        })
    };

    this.mailLoading = function () {
        this.isRegistering = true;
        $("#btnMailRegister").html('正在注册...');
        $("#btnMailRegister").attr("disabled", "disabled");
    };

    this.mailCloseLoading = function () {
        this.isRegistering = false;
        $("#btnMailRegister").html('立 即 注 册');
        $("#btnMailRegister").attr("disabled", "disabled");
    };

    this.disPwdStrength = function () {
        $('.password-strong').hide();
        $('.password-strong p').hide();
    };

    this.loading = function () {
        this.isRegistering = true;
        $("#btnPhoneRegister").html('正在注册...');
        $("#btnPhoneRegister").attr("disabled", "disabled");

    };

    this.closeLoading = function () {
        this.isRegistering = false;
        $("#btnPhoneRegister").html('立 即 注 册');
        $("#btnPhoneRegister").removeAttr("disabled");
    };

    this.showError = function (id, msg, showid) {
        $('#' + id + ' .icon-pass').remove();
        $('#' + id + ' .icon-error').remove();
        $('#' + id + ' .error-tip').remove();
        var spanhtml = '<i class="sprite icon-error"></i><p class="error-tip">' + msg + '</p></dd>'
        $('#' + id).addClass('error');
        if (showid) {
            $('#' + showid).html(spanhtml);
        }
        else {
            $('#' + id).append(spanhtml);
        }
    };

    this.hideError = function (id, showid) {

        $('#' + id).removeClass('error');
        $('#' + id + ' .icon-pass').remove();
        if (showid) {
            $('#' + showid).html('');
            $('#' + showid).hide();
        }
        else {
            $('#' + id + ' .icon-error').remove();
            $('#' + id + ' .error-tip').remove();
        }
    };

    this.showPassTip = function (id, showid) {
        $('#' + id).removeClass('error');
        $('#' + id + ' .icon-pass').remove();
        $('#' + id + ' .icon-error').remove();
        $('#' + id + ' .error-tip').remove();

        if (showid) {
            $('#' + showid).html('<i class="sprite icon-pass"></i>');
            $('#' + showid).css('display', 'inline-block');
        }
        else {
            $('#' + id).append('<i class="sprite icon-pass"></i>');
        }
    };

    this.init();
}

QRegister();