<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理员登录 - 趣二手</title>

    <!-- ThirdParty -->
    <script src="/platform/Public/lib/vue.min.js"></script>
    <script src="/platform/Public/lib/element.min.js"></script>
    <link rel="stylesheet" href="/platform/Public/lib/normalize.css">
    <link rel="stylesheet" href="/platform/Public/lib/element.min.css">
    <link rel="stylesheet" href="/platform/Public/lib/fonts/iconfont.css">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="/platform/Public/css/login/login-admin.css">
</head>
<body>
    <!-- Layout -->
    <div id="app">
        <el-container>

            <!-- Header 区域 -->
            <el-header><span class="logo">趣二手 管理平台</span></el-header>

            <!-- 内容区域 -->
            <el-main>
                <div class="wrap">
                    <div class="title">管理员登录</div>
                    <div class="items">
                        <!-- 管理员登录表单 -->
                        <form action="" method="POST">
                            <div class="item">
                                <label class="label" for="username"><i class="icon iconfont icon-people_fill"></i></label>
                                <input name="username" type="text" class="cont" placeholder="登录账号" autocomplete="off" maxlength="11">
                            </div>
                            <div class="item">
                                <label class="label" for="password"><i class="icon iconfont icon-brush"></i></label>
                                <input name="password" type="password" class="cont" placeholder="输入密码" autocomplete="off" maxlength="16">
                            </div>
                            <input class="submit-Btn" type="submit" value="立即登录">
                        </form>
                    </div>
                </div>
            </el-main>

            <!-- Footer区域 -->
            <el-footer>
                <div class="links"> 
                    <a target="_blank" href="http://www.xiyou.edu.cn/">西邮官网</a> | 
                    <a target="_blank" href="http://cs.xupt.edu.cn:81/xiyoucs/index.asp">计算机学院</a> | 
                    <a target="_blank" href="http://gr.xupt.edu.cn/">研究生院</a> | 
                    <a href="./login.html">普通用户登录</a>
                </div>
                <p class="copyright"> Copyright © 2018 趣二手 All Rights Reserved </p>
            </el-footer>

        </el-container>
    </div>

    <!-- VUE -->
    <script>
        var app = new Vue({
            el: '#app',
            data: {
            },
            methods: {
            }
        })
    </script>
</body>
</html>