<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$system_name}}</title>
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="{{asset('static/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/plugins/fontawesome/css/font-awesome.min.css')}}" rel="stylesheet"/>
    <script>
        if (window !== top) top.location.replace(location.href);
    </script>
	<style>
        .lockscreen{background:#d2d6de;height:auto;}
        .lockscreen-name{text-align:center;font-weight:600;margin-top:50px;margin-bottom:30px;}
        .lockscreen-wrapper{max-width:400px;margin:10% auto;z-index:800;position:relative;}
        .lockscreen-item{border-radius:4px;padding:0;background:#fff;position:relative;margin:10px auto 30px auto;width:290px}
        .lockscreen-image{border-radius:50%;position:absolute;left:-10px;top:-25px;background:#fff;padding:5px;z-index:10}
        .lockscreen-image>img{border-radius:50%;width:70px;height:70px}
        .lockscreen-credentials{margin-left:70px}
        .lockscreen-credentials .form-control{border:0}
        .lockscreen-credentials .btn{background-color:#fff;border:0;padding:0 10px}
        .lockscreen-footer{margin-top:150px}
        .lockscreen-time{width:100%;color:#fff;font-size:60px;display:inline-block;text-align:center;font-family:'Open Sans',sans-serif;font-weight:300;}
    </style>
</head>
<body class="lockscreen">
<div class="lockscreen-wrapper">
    <div class="lockscreen-time"></div>
    <div class="lockscreen-name">{{$user['username']}} /{{$user['name']}}</div>

    <div class="lockscreen-item">
        <div class="lockscreen-image">
            <img src="{{asset('static/admin/images/profile.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <form class="lockscreen-credentials" method="post" action="#" onsubmit="return false;" id="lockscreen-form">
            <div class="input-group">
                <input type="password" name="password" autocomplete="off" class="form-control" placeholder="密码">
                <div class="input-group-btn">
                    <button type="button" class="btn" onclick="unlock()"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div class="help-block text-center" style="margin-top: 50px;">系统锁屏,请输入密码登陆!</div>
    <div class="text-center">
        <a href="{{route('admin.logout')}}">退出重新登陆</a>
    </div>
</div>
<script src="{{asset('static/plugins/jquery/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('static/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('static/plugins/three-js/three.min.js')}}"></script>
<script src="{{asset('static/plugins/layui/layui.js')}}"></script>
<script src="{{asset('static/admin/js/iframe-ui.js')}}"></script>
<script src="{{asset('static/admin/js/common.js')}}"></script>
<script >
	function getTime(){
        var date=new Date();
        var hour=date.getHours();
        var minute=date.getMinutes();
        var second=date.getSeconds();
        hour=hour<10?'0'+hour:hour;
        minute=minute<10?'0'+minute:minute;
        second=second<10?'0'+second:second;
        return hour+':'+minute+':'+second;
    }

    $(function() {
        $('.lockscreen-time').text(getTime());
        setInterval(function() {
            $('.lockscreen-time').text(getTime());
        }, 500);
        init();
        animate();
    });

    $(document).keydown(function(event) {
   	    if (event.keyCode == 13) {
   	    	unlock();
   	    }
   	});

    function unlock() {
        var password = $("input[name='password']").val();
        if ($.common.isEmpty(password)) {
        	$.modal.tips("请输入密码");
            return;
        }

        var config = {
            url: "{{route('admin.lockscreen')}}",
            type: "post",
            dataType: "json",
            data: $("#lockscreen-form").serialize(),
            beforeSend: function() {
            	$.modal.b5showload();
            },
            success: function(result) {
                if (result.code == web_status.SUCCESS) {
                    location.href = "{{route('admin.index')}}";
                } else {
                    $.modal.msg(result.msg);
                    $("input[name='password']").val("");
                }

            },
            complete:function () {
                $.modal.b5hideload();
            },
            error:function () {
                $.modal.msgWarning("网络连接错误");
            }
        };
        $.ajax(config);
    };

    var container;
    var camera, scene, projector, renderer;
    var PI2 = Math.PI * 2;

    var programFill = function(context) {
        context.beginPath();
        context.arc(0, 0, 1, 0, PI2, true);
        context.closePath();
        context.fill();
    };

    var programStroke = function(context) {
        context.lineWidth = 0.05;
        context.beginPath();
        context.arc(0, 0, 1, 0, PI2, true);
        context.closePath();
        context.stroke();
    };

    var mouse = { x: 0, y: 0 }, INTERSECTED;
    function init() {
    	container = document.createElement('div');
    	container.id = 'bgc';
    	container.style.position = 'absolute';
    	container.style.zIndex = '0';
    	container.style.top = '0px';
    	$(".lockscreen-wrapper").before(container);

        camera = new THREE.PerspectiveCamera(70, window.innerWidth / window.innerHeight, 1, 10000);
        camera.position.set(0, 300, 500);
        scene = new THREE.Scene();

        for (var i = 0; i < 100; i++) {
            var particle = new THREE.Particle(new THREE.ParticleCanvasMaterial({ color: Math.random() * 0x808080 + 0x808080, program: programStroke }));
            particle.position.x = Math.random() * 800 - 400;
            particle.position.y = Math.random() * 800 - 400;
            particle.position.z = Math.random() * 800 - 400;
            particle.scale.x = particle.scale.y = Math.random() * 10 + 10;
            scene.add(particle);
        }
        projector = new THREE.Projector();
        renderer = new THREE.CanvasRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight - 10);
        container.appendChild(renderer.domElement);
        document.addEventListener('mousemove', onDocumentMouseMove, false);
        window.addEventListener('resize', onWindowResize, false);
    };

    function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight - 10);
    };

    function onDocumentMouseMove(event) {
        event.preventDefault();
        mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
        mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
    };

    function animate() {
        requestAnimationFrame(animate);
        render();
    };

    var radius = 600;
    var theta = 0;

    function render() {
    	theta += 0.2;
    	camera.position.x = radius * Math.sin(theta * Math.PI / 360);
    	camera.position.y = radius * Math.sin(theta * Math.PI / 360);
    	camera.position.z = radius * Math.cos(theta * Math.PI / 360);
    	camera.lookAt(scene.position);
    	camera.updateMatrixWorld();

    	var vector = new THREE.Vector3(mouse.x, mouse.y, 0.5);
    	projector.unprojectVector(vector, camera);

    	var ray = new THREE.Ray(camera.position, vector.subSelf(camera.position).normalize());
    	var intersects = ray.intersectObjects(scene.children);

        if (intersects.length > 0) {
            if (INTERSECTED != intersects[0].object) {
                if (INTERSECTED) INTERSECTED.material.program = programStroke;
                INTERSECTED = intersects[0].object;
                INTERSECTED.material.program = programFill;
            }
        } else {
            if (INTERSECTED) INTERSECTED.material.program = programStroke;
            INTERSECTED = null;
        }
        renderer.render(scene, camera);
    }
</script>
</body>
</html>
