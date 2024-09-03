<!DOCTYPE html>
<html lang="en">
<div class="container">
</div>

<head>
    <meta charset="utf-8">

    <title>Create Invoice</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <title>Find Job Status</title>

    <style>
        body {
            font-family: 'Alatsi', sans-serif;
            margin: 0;
            overflow: hidden;
            background: black;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
            width: 100vw;
            height: 300vh;
        }

        .title {
            font-size: 10vw;
            color: white;
        }

        canvas {
            width: 100%;
        }


        @import url('https://fonts.googleapis.com/css?family=Lato:400,700');

        *,
        *:before,
        *:after {
            -webkit-box-sizing: inherit;
            -moz-box-sizing: inherit;
            box-sizing: inherit;
        }

        ::-webkit-input-placeholder {
            color: #56585b;
        }

        ::-moz-placeholder {
            color: #56585b;
        }

        :-moz-placeholder {
            color: #56585b;
        }

        html {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            color: #0a0a0b;
            overflow: hidden;
        }

        ul,
        nav {
            list-style: none;
            padding: 0;
        }

        a {
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            opacity: 0.9;
        }

        a:hover {
            opacity: 1;
        }

        h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #fff;
            margin: 0 0 1.5rem;
        }

        h5 {
            font-size: 1rem;
            font-weight: 50;
            color: #fff;
            margin: 0 0 1.5rem;
        }

        i {
            font-size: 1.3rem;
        }

        header {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 10;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
            padding: 100px 100px 0;
        }

        header nav ul {
            display: flex;
        }

        header nav li {
            margin: 0 15px;
        }

        header nav li:first-child {
            margin-left: 0;
        }

        header nav li:last-child {
            margin-right: 0;
        }

        a.btn {
            color: #fff;
            padding: 10px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            -webkit-transition: all 0.2s;
            -moz-transition: all 0.2s;
            transition: all 0.2s;
        }

        a.btn:hover {
            background: #d73851;
            border: 1px solid #d73851;
            color: #fff;
        }

        .cover {
            height: 100vh;
            width: 100%;
            background: -webkit-gradient(linear, left top, left bottom, from(rgba(0, 0, 0, 0.05)), to(rgba(0, 0, 0, 0)));
            background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0) 100%);
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0) 100%);
            padding: 20px 50px;
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            -webkit-box-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            align-items: center;
        }

        .flex-form input[type="submit"] {
            background: #ef3f5a;
            border: 1px solid #ef3f5a;
            color: #fff;
            padding: 0 30px;
            cursor: pointer;
            -webkit-transition: all 0.2s;
            -moz-transition: all 0.2s;
            transition: all 0.2s;
        }

        .flex-form input[type="button"] {
            background: #ef3f5a;
            border: 1px solid #ef3f5a;
            color: #fff;
            padding: 0 30px;
            cursor: pointer;
            -webkit-transition: all 0.2s;
            -moz-transition: all 0.2s;
            transition: all 0.2s;
        }

        .flex-form input[type="submit"]:hover {
            background: #d73851;
            border: 1px solid #d73851;
        }

        .flex-form input[type="button"]:hover {
            background: #d73851;
            border: 1px solid #d73851;
        }

        .flex-form {
            display: -webkit-box;
            display: flex;
            z-index: 10;
            position: relative;
            width: 500px;
            box-shadow: 4px 8px 16px rgba(0, 0, 0, 0.3);
        }

        .flex-form>* {
            border: 0;
            padding: 0 0 0 10px;
            background: #fff;
            line-height: 50px;
            font-size: 1rem;
            border-radius: 0;
            outline: 0;
            -webkit-appearance: none;
        }

        input[type="search"] {
            flex-basis: 500px;
        }

        #madeby {
            position: absolute;
            bottom: 0;
            right: 0;
            padding: 25px 100px;
            color: #fff;
        }


        #table {
            position: relative;
            bottom: 0;
            right: 0;
            padding: 105px 25px;
        }

        @media all and (max-width:800px) {
            body {
                font-size: 0.9rem;
            }

            .flex-form {
                width: 100%;
            }

            input[type="search"] {
                flex-basis: 100%;
            }

            .flex-form>* {
                font-size: 0.9rem;
            }

            header {
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                flex-direction: column;
                padding: 10px !important;
            }

            header h2 {
                margin-bottom: 15px;
            }

            h1 {
                font-size: 2rem;

            }

            h3 {
                font-size: 2rem;
                color: #fff;

            }

            .cover {
                padding: 20px;
            }

            #madeby {
                padding: 30px 20px;
            }
        }

        @media all and (max-width:360px) {
            header nav li {
                margin: 0 10px;
            }

            .flex-form {
                display: -webkit-box;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                flex-direction: column;
            }

            input[type="search"] {
                flex-basis: 0;
            }

            label {
                display: none;
            }
        }

        img {
            display: block;
            margin: 0 auto;
            width: 100%;
        }

        filter: drop-shadow(2px 1px 2px #f7f7f7);

        */ #photo {
            text-align: center;
        }

        /*
 Table */
        html,
        body {
            height: 100%;
        }

        /* body {
	margin: 0;
	background: linear-gradient(45deg, #49a09d, #5f2c82);
	font-family: sans-serif;
	font-weight: 100;
    } */

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        table {
            width: 800px;
            border-collapse: collapse;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        th {
            text-align: left;

        }

        #TableTh {
            background: linear-gradient(0.25turn, #ee54c8, #0890df);

        }

        thead {
            th {
                background-color: #55608f;
            }
        }

        tbody {
            tr {
                &:hover {
                    background-color: rgba(255, 255, 255, 0.3);
                }
            }

            td {
                position: relative;

                &:hover {
                    &:before {
                        content: "";
                        position: absolute;
                        left: 0;
                        right: 0;
                        top: -9999px;
                        bottom: -9999px;
                        background-color: rgba(255, 255, 255, 0.2);
                        z-index: -1;
                    }
                }
            }
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="container">

            <header>

            </header>

            <div class="cover">
                <div id="photo">
                    <img src="http://toyto.lk/wp-content/uploads/2021/05/Toyto-MobileShop.png">
                </div>
                @foreach($Company as $Details)
                <h1>{{$Details->name}}</h1>
                @endforeach
                <form class="flex-form">
                    <label for="from">
                        <i class="ion-location"></i>
                    </label>

                    <input type="search" id="search_phone_no" name="search_phone_no"
                        placeholder="Enter Your Phone Number ">
                    <input type="button" id="submit" value="Submit">
                </form>
                <br>

                <br>
                <h5 style="font-weight: bold;">CHECK YOUR REPARE DEVICE STATUS IN HERE </h5>


                <div id="table" class="table">

                    <div class="container" style="overflow-x: auto;">
                        <table id="jobTable" style="display: none; " >
                            <thead>
                                <tr style="background: linear-gradient(0.25turn, #ee54c8, #0890df);">
                                    <th>Job No</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>IMEI No</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table rows will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="madeby">
                    <span>
                        <div class="footer">
                            <p>
                                <p class="text-center">© Smart Omega (PVT) Ltd . All Rights Reserved. Designed by Smart
                                    Omega</p>
                            </p>
                        </div>
                    </span>
                </div>
            </div>


        </div>
    </div>




    {{--  get customer data inserting job no --}}
    <script>
        $("#submit").click(function () {
            var search_string = $('#search_phone_no').val();
            if (search_string>null) {
                $.ajax({
                    url: "{{ route('get_job_status_ajax') }}",
                    method: 'GET',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        search_string: search_string
                    },
                    success: function (res) {
                        if (res.status == 'success') {
                            let data = res.jobData;
                            $('#jobTable tbody').empty();

                            data.forEach(function (job) {
                                const tableRow = $('<tr style="font-weight: bold;">');
                                tableRow.append('<td>' + job.Job_no + '</td>');
                                tableRow.append('<td>' + job.Customer_Name + '</td>');
                                tableRow.append('<td>' + job.Brand + '</td>');
                                tableRow.append('<td>' + job.Device_Model + '</td>');
                                tableRow.append('<td>' + job.IMEI_Number + '</td>');
                                // tableRow.append('<td>' + job.Status + '</td>');

                                if (job.Status === 'Pending') {
                                    tableRow.append('<td style="color: #ffff00;">' + job.Status + '</td>');
                                } else if (job.Status === 'Complete') {
                                    tableRow.append('<td style="color: #00ff00;">' + job.Status + '</td>');
                                } else if (job.Status === 'Reject') {
                                    tableRow.append('<td style="color: #ff3300;">' + job.Status + '</td>');
                                } else if (job.Status === 'Delivered') {
                                    tableRow.append('<td style="color: #33ccff;">' + job.Status + '</td>');
                                } else {
                                    tableRow.append('<td>' + job.Status + '</td>');
                                }

                                $('#jobTable tbody').append(tableRow);
                            });

                            $('#jobTable').show(); // Make the table visible

                            }

                        if (res.status == 'not_found') {
                            $('#table').html(
                                `   <div class="form-group text-center m-1">
                                                <label style="color:white; "> Job Not Found...! </label>
                                            </div>
                                                    `
                            );

                        }
                    }
                });

            }else{
                alert("Please Enter Your Mobile Number");
            }

        });

    </script>


    {{-- CSRF Token --}}
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>

    {{-- script for background --}}
    <script>
        var canvas = document.createElement("canvas");
        var width = canvas.width = window.innerWidth * 0.75;
        var height = canvas.height = window.innerHeight * 0.75;
        document.body.appendChild(canvas);
        var gl = canvas.getContext('webgl');

        var mouse = {
            x: 0,
            y: 0
        };

        var numMetaballs = 30;
        var metaballs = [];

        for (var i = 0; i < numMetaballs; i++) {
            var radius = Math.random() * 60 + 10;
            metaballs.push({
                x: Math.random() * (width - 2 * radius) + radius,
                y: Math.random() * (height - 2 * radius) + radius,
                vx: (Math.random() - 0.5) * 3,
                vy: (Math.random() - 0.5) * 3,
                r: radius * 0.75
            });
        }

        var vertexShaderSrc = `
        attribute vec2 position;

        void main() {
        // position specifies only x and y.
        // We set z to be 0.0, and w to be 1.0
        gl_Position = vec4(position, 0.0, 1.0);
        }
        `;

                var fragmentShaderSrc = `
        precision highp float;

        const float WIDTH = ` + (width >> 0) + `.0;
        const float HEIGHT = ` + (height >> 0) + `.0;

        uniform vec3 metaballs[` + numMetaballs + `];

        void main(){
        float x = gl_FragCoord.x;
        float y = gl_FragCoord.y;

        float sum = 0.0;
        for (int i = 0; i < ` + numMetaballs + `; i++) {
        vec3 metaball = metaballs[i];
        float dx = metaball.x - x;
        float dy = metaball.y - y;
        float radius = metaball.z;

        sum += (radius * radius) / (dx * dx + dy * dy);
        }

        if (sum >= 0.99) {
        gl_FragColor = vec4(mix(vec3(x / WIDTH, y / HEIGHT, 1.0), vec3(0, 0, 0), max(0.0, 1.0 - (sum - 0.99) * 100.0)), 1.0);
        return;
        }

        gl_FragColor = vec4(0.0, 0.0, 0.0, 1.0);
        }

        `;

        var vertexShader = compileShader(vertexShaderSrc, gl.VERTEX_SHADER);
        var fragmentShader = compileShader(fragmentShaderSrc, gl.FRAGMENT_SHADER);

        var program = gl.createProgram();
        gl.attachShader(program, vertexShader);
        gl.attachShader(program, fragmentShader);
        gl.linkProgram(program);
        gl.useProgram(program);

        var vertexData = new Float32Array([
            -1.0, 1.0, // top left
            -1.0, -1.0, // bottom left
            1.0, 1.0, // top right
            1.0, -1.0, // bottom right
        ]);
        var vertexDataBuffer = gl.createBuffer();
        gl.bindBuffer(gl.ARRAY_BUFFER, vertexDataBuffer);
        gl.bufferData(gl.ARRAY_BUFFER, vertexData, gl.STATIC_DRAW);

        var positionHandle = getAttribLocation(program, 'position');
        gl.enableVertexAttribArray(positionHandle);
        gl.vertexAttribPointer(positionHandle,
            2, // position is a vec2
            gl.FLOAT, // each component is a float
            gl.FALSE, // don't normalize values
            2 * 4, // two 4 byte float components per vertex
            0 // offset into each span of vertex data
        );

        var metaballsHandle = getUniformLocation(program, 'metaballs');

        loop();

        function loop() {
            for (var i = 0; i < numMetaballs; i++) {
                var metaball = metaballs[i];
                metaball.x += metaball.vx;
                metaball.y += metaball.vy;

                if (metaball.x < metaball.r || metaball.x > width - metaball.r) metaball.vx *= -1;
                if (metaball.y < metaball.r || metaball.y > height - metaball.r) metaball.vy *= -1;
            }

            var dataToSendToGPU = new Float32Array(3 * numMetaballs);
            for (var i = 0; i < numMetaballs; i++) {
                var baseIndex = 3 * i;
                var mb = metaballs[i];
                dataToSendToGPU[baseIndex + 0] = mb.x;
                dataToSendToGPU[baseIndex + 1] = mb.y;
                dataToSendToGPU[baseIndex + 2] = mb.r;
            }
            gl.uniform3fv(metaballsHandle, dataToSendToGPU);

            //Draw
            gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);

            requestAnimationFrame(loop);
        }

        function compileShader(shaderSource, shaderType) {
            var shader = gl.createShader(shaderType);
            gl.shaderSource(shader, shaderSource);
            gl.compileShader(shader);

            if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
                throw "Shader compile failed with: " + gl.getShaderInfoLog(shader);
            }

            return shader;
        }

        function getUniformLocation(program, name) {
            var uniformLocation = gl.getUniformLocation(program, name);
            if (uniformLocation === -1) {
                throw 'Can not find uniform ' + name + '.';
            }
            return uniformLocation;
        }

        function getAttribLocation(program, name) {
            var attributeLocation = gl.getAttribLocation(program, name);
            if (attributeLocation === -1) {
                throw 'Can not find attribute ' + name + '.';
            }
            return attributeLocation;
        }

        canvas.onmousemove = function (e) {
            mouse.x = e.clientX;
            mouse.y = e.clientY;
        }

    </script>



    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
