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
                <h1 class="masthead-heading mb-0">ISLP</h1>
                <h2 class="masthead-subheading mb-0">National Statistics Poster Competiton</h2>
                <h3>January 3rd, 2019</h3>
                <a href="#" class="btn btn-primary btn-xl rounded-pill mt-5">How to Participate</a>
            </div>
        </div>
    </header>


    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4"><i class="fa fa-question" aria-hidden="true"></i> What is ISLP Poster Competition</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="p-5">
                        <canvas id="line-chart"></canvas>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <h2 class="display-4"><i class="fa fa-pencil" aria-hidden="true"></i> Create, Share, Compete</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="invert-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Student? Participate Today!</h2>
                        <p>Ask your teacher about ISLP national poster competition and participate today! There are many prizes to be won.</p>
                        <a href="#" class="btn btn-primary btn-xl rounded-pill mt-5">Sample Posters</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4"><i class="fa fa-list-ol" aria-hidden="true"></i> Rules</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4"><i class="fa fa-calendar" aria-hidden="true"></i> Schedule</h2>
                        <div id="example5.2" style="height: 250px; overflow-x: scroll; overflow-y: hidden"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 bg-black">
        <div class="container">
            <p class="m-0 text-center text-white small">Copyright &copy; ISLP 2018 All Rights Reserved</p>
        </div>
        <!-- /.container -->
    </footer>

    <script>
        var s = Snap("#header-svg");
        // Lets create big circle in the middle:
        var rects = [];
        for(let i = 0; i < 50; i++){
            let height = Math.floor((Math.random() * 300) + 100);
            let rect = s.rect(55 * i, 0, 50, 0, 5, 5);
            rect.attr({
                fill: '#B71C1C',
                opacity: Math.random()
            });

            setTimeout(function(){
                Snap.animate(0, height, function (val) {
                    rect.attr({
                        height: val,
                        y: 720 - val
                    });
                }, Math.floor((Math.random() * 3000) + 2800), mina.elastic);
            }, Math.floor((Math.random() * 200) + 100));

            rects.push(rect)
        }
    </script>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load("current", {packages:["timeline"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

            var container = document.getElementById('example5.2');
            var chart = new google.visualization.Timeline(container);
            var dataTable = new google.visualization.DataTable();

            dataTable.addColumn({ type: 'string', id: 'Room' });
            dataTable.addColumn({ type: 'string', id: 'Name' });
            dataTable.addColumn({ type: 'date', id: 'Start' });
            dataTable.addColumn({ type: 'date', id: 'End' });
            dataTable.addRows([
                [ 'Magnolia Room',  'CSS Fundamentals',    new Date(0,0,0,12,0,0),  new Date(0,0,0,14,0,0) ],
                [ 'Magnolia Room',  'Intro JavaScript',    new Date(0,0,0,14,30,0), new Date(0,0,0,16,0,0) ],
                [ 'Magnolia Room',  'Advanced JavaScript', new Date(0,0,0,16,30,0), new Date(0,0,0,19,0,0) ],
                [ 'Gladiolus Room', 'Intermediate Perl',   new Date(0,0,0,12,30,0), new Date(0,0,0,14,0,0) ],
                [ 'Gladiolus Room', 'Advanced Perl',       new Date(0,0,0,14,30,0), new Date(0,0,0,16,0,0) ],
                [ 'Gladiolus Room', 'Applied Perl',        new Date(0,0,0,16,30,0), new Date(0,0,0,18,0,0) ],
                [ 'Petunia Room',   'Google Charts',       new Date(0,0,0,12,30,0), new Date(0,0,0,14,0,0) ],
                [ 'Petunia Room',   'Closure',             new Date(0,0,0,14,30,0), new Date(0,0,0,16,0,0) ],
                [ 'Petunia Room',   'App Engine',          new Date(0,0,0,16,30,0), new Date(0,0,0,18,30,0) ]]);

            var options = {
                timeline: { singleColor: '#8d8' },
            };

            chart.draw(dataTable, options);
        }
    </script>


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
                            beginAtZero:true
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
                labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
                datasets: [{
                    data: [86,114,106,106,107,111,133,221,783,2478],
                    label: "Africa",
                    borderColor: "#3e95cd",
                    fill: false
                }, {
                    data: [282,350,411,502,635,809,947,1402,3700,5267],
                    label: "Asia",
                    borderColor: "#8e5ea2",
                    fill: false
                }, {
                    data: [168,170,178,190,203,276,408,547,675,734],
                    label: "Europe",
                    borderColor: "#3cba9f",
                    fill: false
                }, {
                    data: [40,20,10,16,24,38,74,167,508,784],
                    label: "Latin America",
                    borderColor: "#e8c3b9",
                    fill: false
                }, {
                    data: [6,3,2,2,7,26,82,172,312,433],
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
        sr.reveal('h1');
        sr.reveal('h2');
        sr.reveal('h3');
        sr.reveal('p');
    </script>
@endsection