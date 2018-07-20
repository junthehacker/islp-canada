@php
    use App\StringResource;
@endphp

@extends('layouts/landing')

@section('content')

    <header class="masthead text-center text-white" id="home">
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
                @if (session('mentor_signup_error'))
                    <div class="alert alert-danger">
                        {{ session('mentor_signup_error') }}
                    </div>
                @endif
                @if (session('mentor_signup_success'))
                    <div class="alert alert-primary">
                        {{ session('mentor_signup_success') }}
                    </div>
                @endif
                <h1 class="masthead-heading mb-0">{{ StringResource::get('landing_title_1') }}</h1>
                <h2 class="masthead-subheading mb-0">{{ StringResource::get('landing_title_2') }}</h2>
                <h3>{{ StringResource::get('landing_title_3') }}</h3>
                <a href="#register"
                   class="btn btn-primary btn-xl rounded-pill mt-5">{{ StringResource::get('landing_how_to_participate_button') }}</a>
            </div>
        </div>
    </header>


    <section class="reveal" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4"><img src="{{ asset('images/question.jpg') }}" height="100"/>
                            {{ StringResource::get('landing_feature_1_title') }}
                        </h2>
                        <p>
                            {!! StringResource::get('landing_feature_1_content') !!}
                        </p>
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
                        <h2 class="display-4"><img src="{{ asset('images/drawing.jpg') }}" height="100"/>
                            {{ StringResource::get('landing_feature_2_title') }}
                        </h2>
                        <p>
                            {!! StringResource::get('landing_feature_2_content') !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="invert-section" id="register">
        <div class="container reveal">
            <div class="row align-items-center">
                <div class="col-lg-12 order-lg-1">
                    <div class="p-5">
                        <div class="pill-header">
                            <div class="pill-header-inner">
                                <button class="left active" id="student-button" onClick="switchToStudent();">Student
                                </button><button class="right" id="teacher-button" onClick="switchToTeacher();">Teacher</button>
                            </div>
                        </div>
                        <div id="student-section">
                            <h2 class="display-4">
                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                {{ StringResource::get('landing_student_title') }}
                            </h2>
                            {!! StringResource::get('landing_student_content') !!}
                            <a href="#" class="btn btn-primary btn-xl rounded-pill mt-5" onclick="openPhotoSwipe()">
                                <i class="fa fa-picture-o"
                                   aria-hidden="true"></i> {{ StringResource::get('landing_sample_posters') }}</a>
                            <br><br><br><br>
                            <h3>{{ StringResource::get('landing_undergraduate_title') }}</h3>
                            {!! StringResource::get('landing_undergraduate_content') !!}
                            <a href="#" class="btn btn-primary btn-xl rounded-pill mt-5"
                               id="show-mentor-application-button" onclick="showMentorApplication()">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                {{ StringResource::get('landing_mentor_application') }}
                            </a>
                            @include('partials/mentorregister')
                        </div>
                        <div class="hidden" id="teacher-section">
                            <h2 class="display-4"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                {{ StringResource::get('landing_teacher_title') }}
                            </h2>
                            {!! StringResource::get('landing_teacher_content') !!}
                            @include('partials/teacherregister')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="reveal" id="rules">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4"><i class="fa fa-list-ol"
                                                 aria-hidden="true"></i> {{ StringResource::get('landing_rules_title') }}
                        </h2>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>{{ StringResource::get('landing_rules_who_can_take_part_title') }}</h3>
                                {!! StringResource::get('landing_rules_who_can_take_part_content') !!}
                                <h3>{{ StringResource::get('landing_rules_how_can_i_participate_title') }}</h3>
                                {!! StringResource::get('landing_rules_how_can_i_participate_content') !!}
                                <h3>{{ StringResource::get('landing_rules_how_must_does_it_cost_title') }}</h3>
                                {!! StringResource::get('landing_rules_how_must_does_it_cost_content') !!}
                            </div>
                            <div class="col-md-6">
                                <h3>{{ StringResource::get('landing_rules_poster_content_title') }}</h3>
                                {!! StringResource::get('landing_rules_poster_content_content') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>{{ StringResource::get('landing_rules_other_title') }}</h3>
                                {!! StringResource::get('landing_rules_other_content') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="reveal" id="schedule">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            {{ StringResource::get('landing_schedule_title') }}
                        </h2>
                        {!! StringResource::get('landing_schedule_content') !!}
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
                fill: '#c8dae7',
                opacity: Math.random() * 0.5
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

        if ($(this).scrollTop() > 200) {
            $("#primary-nav").addClass("filled");
        } else {
            $("#primary-nav").removeClass("filled");
        }

        function switchToStudent() {
            $("#student-button").addClass("active");
            $("#teacher-button").removeClass("active");
            $("#student-section").removeClass("hidden");
            $("#teacher-section").addClass("hidden");
        }

        function switchToTeacher() {
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

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();

        });

        function showMentorApplication() {
            $("#mentor-application-form").slideDown();
            $('#show-mentor-application-button')
                .stop(true, true)
                .animate({
                    height: "toggle",
                    padding: "toggle",
                    margin: "toggle",
                    opacity: "toggle"
                }, 500)
        }

        $(document).on('click', 'a[href^="#"]', function (event) {
            event.preventDefault();

            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top
            }, 500);
        });
    </script>
@endsection