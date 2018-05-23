@extends('layouts/landing')

@section('content')

    <header class="masthead text-center text-white">
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
        <svg id="header-svg"></svg>
        <div class="masthead-content">
            <div class="container">
                @if (session('teacher_signup_error'))
                    <div class="alert alert-danger">
                        {{ session('teacher_signup_error') }}
                    </div>
                @endif
                @if (session('teacher_signup_success'))
                    <div class="alert alert-primary">
                        {{ session('teacher_signup_success') }}
                    </div>
                @endif
                <h1 class="masthead-heading mb-0">ISLP</h1>
                <h2 class="masthead-subheading mb-0">Canadian National Statistics Poster Competiton</h2>
                <h3>Create, Share, Compete</h3>
                <a href="#" class="btn btn-primary btn-xl rounded-pill mt-5">How to Participate</a>
            </div>
        </div>
    </header>


    <section class="reveal">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4"><i class="fa fa-question" aria-hidden="true"></i> What is ISLP Poster
                            Competition</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam
                            sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione
                            voluptatum molestiae adipisci, beatae obcaecati.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="reveal">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="p-5">
                        <canvas id="line-chart"></canvas>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <h2 class="display-4"><i class="fa fa-pencil" aria-hidden="true"></i> Create, Share, Compete
                        </h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam
                            sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione
                            voluptatum molestiae adipisci, beatae obcaecati.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="invert-section">
        <div class="container reveal">
            <div class="row align-items-center">
                <div class="col-lg-12 order-lg-1">
                    <div class="p-5">
                        <div class="pill-header">
                            <div class="pill-header-inner">
                                <button class="left active" id="student-button" onClick="switchToStudent();">Student</button><button class="right" id="teacher-button" onClick="switchToTeacher();">Teacher</button>
                            </div>
                        </div>
                        <div id="student-section">
                            <h2 class="display-4"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Student?
                                Participate Today!</h2>
                            <p>Ask your teacher about ISLP national poster competition and participate today! There are
                                many prizes to be won.</p>
                            <a href="#" class="btn btn-primary btn-xl rounded-pill mt-5">Sample Posters</a>
                        </div>
                        <div class="hidden" id="teacher-section">
                            <h2 class="display-4"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Register Your Class</h2>
                            <p>
                                Register your class today for ISLP national statistics competition! An account allows
                                you to submit posters, manage submissions, and ask questions on the forum.<br>
                                All information collected is for the competition only, we never share your information
                                with anyone else.
                            </p>
                            <form action="{{ url('/portal/signup/teacher') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6 pad-top">
                                        <label for="teacher-fullname">Full Name *</label>
                                        <input type="text" name="name" class="form-control inverted" id="teacher-fullname"/>
                                    </div>
                                    <div class="col-md-6 pad-top">
                                        <label for="teacher-email">Email Address (Work) *</label>
                                        <input type="email" name="email" class="form-control inverted" id="teacher-email"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pad-top">
                                        <label for="teacher-subject">Teaching Subject *</label>
                                        <input type="text" name="teaching_subject" class="form-control inverted" id="teacher-subject"/>
                                    </div>
                                    <div class="col-md-6 pad-top">
                                        <label for="teacher-hear">How did you hear about ISLP? *</label>
                                        <input type="text" name="heard_from" class="form-control inverted" id="teacher-hear"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pad-top">
                                        <label for="teacher-school">School Name *</label>
                                        <input type="text" name="school" class="form-control inverted" id="teacher-school"/>
                                    </div>
                                    <div class="col-md-6 pad-top">
                                        <label for="teacher-password">Choose a password for your account *</label>
                                        <input type="password" name="password" class="form-control inverted" id="teacher-password"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pad-top">
                                        <label for="teacher-resources">Any additional resources required?</label>
                                        <input type="text" name="additional_resources" class="form-control inverted" id="teacher-resources"/>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-xl rounded-pill mt-5">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="reveal">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4"><i class="fa fa-list-ol" aria-hidden="true"></i> Rules</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam
                            sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione
                            voluptatum molestiae adipisci, beatae obcaecati.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="reveal">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4"><i class="fa fa-calendar" aria-hidden="true"></i> Schedule</h2>
                        <p>
                            Deadline to submit posters - February 29th, 2019<br>
                            National winners announced - March 29th, 2019
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 bg-black invert-section-dark">
        <div class="container">
            <p class="m-0 text-center text-white small">
                Copyright &copy; ISLP 2018 All Rights Reserved<br>
            </p>
            <hr>
            <p class="m-0 text-center text-white small footer-logo">
                Production of this website is funded by<br><br>
                <img src="{{ asset('images/scc.png') }}" width="200"/>
            </p>
        </div>
        <!-- /.container -->
    </footer>

    <script>
        var s = Snap("#header-svg");
        // Lets create big circle in the middle:
        var rects = [];
        for (let i = 0; i < 50; i++) {
            let height = Math.floor((Math.random() * 300) + 100);
            let rect = s.rect(55 * i, 0, 50, 0, 5, 5);
            rect.attr({
                fill: '#0D47A1',
                opacity: Math.random()
            });

            setTimeout(function () {
                Snap.animate(0, height, function (val) {
                    rect.attr({
                        height: val,
                        y: 720 - val
                    });
                }, Math.floor((Math.random() * 3000) + 2800), mina.elastic);
            }, Math.floor((Math.random() * 200) + 100));

            rects.push(rect)
        }

        $(function () {
            $(document).scroll(function () {
                if ($(this).scrollTop() > 200) {
                    $("#primary-nav").addClass("filled");
                } else {
                    $("#primary-nav").removeClass("filled");
                }
            })
        });

        function switchToStudent(){
            $("#student-button").addClass("active");
            $("#teacher-button").removeClass("active");
            $("#student-section").removeClass("hidden");
            $("#teacher-section").addClass("hidden");
        }

        function switchToTeacher(){
            $("#teacher-button").addClass("active");
            $("#student-button").removeClass("active");
            $("#teacher-section").removeClass("hidden");
            $("#student-section").addClass("hidden");
        }
    </script>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <script>
        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: [1500, 1600, 1700, 1750, 1800, 1850, 1900, 1950, 1999, 2050],
                datasets: [{
                    data: [86, 114, 106, 106, 107, 111, 133, 221, 783, 2478],
                    label: "Africa",
                    borderColor: "#3e95cd",
                    fill: false
                }, {
                    data: [282, 350, 411, 502, 635, 809, 947, 1402, 3700, 5267],
                    label: "Asia",
                    borderColor: "#8e5ea2",
                    fill: false
                }, {
                    data: [168, 170, 178, 190, 203, 276, 408, 547, 675, 734],
                    label: "Europe",
                    borderColor: "#3cba9f",
                    fill: false
                }, {
                    data: [40, 20, 10, 16, 24, 38, 74, 167, 508, 784],
                    label: "Latin America",
                    borderColor: "#e8c3b9",
                    fill: false
                }, {
                    data: [6, 3, 2, 2, 7, 26, 82, 172, 312, 433],
                    label: "North America",
                    borderColor: "#c45850",
                    fill: false
                }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'World population per region (in millions)'
                }
            }
        });
    </script>

    <script>
        window.sr = ScrollReveal();
        sr.reveal('.reveal');
    </script>
@endsection