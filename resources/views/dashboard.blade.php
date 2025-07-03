@extends('layouts.main')

@section('title', 'Dashboard')
@section('content')
<style>
  .chart-container {
    position: relative;
    width: 100%;
    height: 400px;
    border: 1px solid #ddd; /* Debug border */
  }

  #chart, #chartb, #topc, #topa {
    min-height: 350px;
    width: 100%;
    border: 1px solid #red; /* Debug border */
  }

  @media (max-width: 768px) {
    .chart-container {
      height: 350px;
    }
  }

  .summary .title {
    font-size: 2.5rem;
    font-weight: bold;
  }
  .summary .desc {
    font-size: 1.5rem;
  }

  .card .bg-petro {
    background-color: #12AE4C;
  }
  .card.border-petro {
    border-color: #12AE4C;
  }
</style>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <span class="text-muted font-weight-bold mr-4">
                    <i class="fa fa-tachometer-alt text-warning"></i>
                </span>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
            </div>
            <div>
                <span class="mr-2 d-none d-lg-inline text-dark my-auto" id="time"></span>
            </div>
        </div>
    </div>

   <div class="d-flex flex-column-fluid">
    <div class="container-fluid">
        <div class="row mb-4 summary">
            <div class="col-md-4">
                <div class="card border-petro">
                    <div class="card-body">
                        <h3 class="title">{{ $dataMasuk }}</h3>
                        <div class="desc">Barang Masuk</div>
                    </div>
                    <a href="{{ url('/barangmasuk') }}" class="card-footer text-white bg-petro">
                        Lihat Detail
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-petro">
                    <div class="card-body">
                        <h3 class="title">{{ $dataKeluar ?? 0 }}</h3>
                        <div class="desc">Barang Keluar</div>
                    </div>
                    <a href="{{ url('/barangkeluar') }}" class="card-footer text-white bg-petro">
                        Lihat Detail
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-petro">
                    <div class="card-body">
                        <h3 class="title">{{ $dataReturn ?? 0 }}</h3>
                        <div class="desc">Barang Return</div>
                    </div>
                    <a href="{{ url('/returnbarang') }}" class="card-footer text-white bg-petro">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Jenis Barang</h3>
                            <div class="chart-container">
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Permintaan Consumable & Aset</h3>
                            <div id="chartb"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Top 5 Barang Consumable</h3>
                            <div id="topc"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Top 5 Barang Aset</h3>
                            <div id="topa"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js_page')
<script>
    console.log('Script started');
    
    // Check if jQuery is loaded
    if (typeof $ === 'undefined') {
        console.error('jQuery is not loaded!');
    } else {
        console.log('jQuery loaded successfully');
    }
    
    // Check if ApexCharts is loaded
    if (typeof ApexCharts === 'undefined') {
        console.error('ApexCharts is not loaded!');
        alert('ApexCharts library is missing! Please include it in your layout.');
        // Try to load ApexCharts dynamically
        var script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/apexcharts';
        script.onload = function() {
            console.log('ApexCharts loaded dynamically');
            initCharts();
        };
        document.head.appendChild(script);
    } else {
        console.log('ApexCharts loaded successfully');
        $(document).ready(function() {
            initCharts();
        });
    }

    function initCharts() {
        console.log('Initializing charts...');
        
        // Debug: Check DOM elements
        console.log('Chart elements:', {
            chart: document.querySelector("#chart"),
            chartb: document.querySelector("#chartb"),
            topc: document.querySelector("#topc"),
            topa: document.querySelector("#topa")
        });

        // 1. Jenis Barang (Pie Chart)
        var pie = [];
        @foreach ($pie as $p) 
            pie.push({{ $p->total ?? 0 }});
        @endforeach
        
        console.log('Pie data:', pie);
        
        if (pie.length === 0) {
            pie = [1, 1]; // Default values jika kosong
        }
        
        var pieOptions = {
            colors: ['#2196F3', '#FF1654'],
            series: pie,
            chart: {
                width: '100%',
                height: 350,
                type: 'pie',
            },
            labels: ['Consumable', 'Aset'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: '100%'
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        // 2. Top 5 Barang Consumable
        var topc = [];
        var topk = [];
        @foreach ($topc as $c) 
            topc.push({{ $c->total ?? 0 }});
            topk.push('{{ $c->nama_barang ?? "No Data" }}');
        @endforeach
        
        console.log('Top consumable data:', { data: topc, labels: topk });
        
        if (topc.length === 0) {
            topc = [0];
            topk = ['No Data'];
        }
        
        var topcOptions = {
            colors: ['#2196F3'],
            series: [{
                name: 'Total',
                data: topc
            }],
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top',
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },
            xaxis: {
                categories: topk,
            },
            yaxis: {
                labels: {
                    formatter: function (val) {
                        return Math.round(val);
                    }
                }
            }
        };

        // 3. Top 5 Barang Aset
        var topa = [];
        var tops = [];
        @foreach ($topa as $a) 
            topa.push({{ $a->total ?? 0 }});
            tops.push('{{ $a->nama_barang ?? "No Data" }}');
        @endforeach
        
        console.log('Top asset data:', { data: topa, labels: tops });
        
        if (topa.length === 0) {
            topa = [0];
            tops = ['No Data'];
        }
        
        var topaOptions = {
            colors: ['#FF1654'],
            series: [{
                name: 'Total',
                data: topa
            }],
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top',
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },
            xaxis: {
                categories: tops,
            },
            yaxis: {
                labels: {
                    formatter: function (val) {
                        return Math.round(val);
                    }
                }
            }
        };

        // 4. Permintaan Consumable & Aset (Line Chart)
        var month = [];
        var consumables = [];
        var assets = [];
        @foreach ($month as $m)
            month.push('{{ $m['month'] ?? "" }}');
            consumables.push({{ $m['consumables'] ?? 0 }});
            assets.push({{ $m['assets'] ?? 0 }}); 
        @endforeach
        
        console.log('Line chart data:', { month: month, consumables: consumables, assets: assets });
        
        if (month.length === 0) {
            month = ['No Data'];
            consumables = [0];
            assets = [0];
        }
        
        var lineOptions = {
            series: [{
                name: "Consumables",
                data: consumables
            },
            {
                name: "Assets", 
                data: assets
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ['#2196F3', '#FF1654'],
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Produk Populer Perbulan',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: month,
            }
        };

        // Render charts dengan timeout untuk memastikan DOM ready
        setTimeout(function() {
            try {
                // Render Pie Chart
                if (document.querySelector("#chart")) {
                    var chart = new ApexCharts(document.querySelector("#chart"), pieOptions);
                    chart.render();
                    console.log('Pie chart rendered');
                } else {
                    console.error('Pie chart element not found');
                }

                // Render Line Chart
                if (document.querySelector("#chartb")) {
                    var chartb = new ApexCharts(document.querySelector("#chartb"), lineOptions);
                    chartb.render();
                    console.log('Line chart rendered');
                } else {
                    console.error('Line chart element not found');
                }

                // Render Top Consumable Chart
                if (document.querySelector("#topc")) {
                    var topcChart = new ApexCharts(document.querySelector("#topc"), topcOptions);
                    topcChart.render();
                    console.log('Top consumable chart rendered');
                } else {
                    console.error('Top consumable chart element not found');
                }

                // Render Top Asset Chart
                if (document.querySelector("#topa")) {
                    var topaChart = new ApexCharts(document.querySelector("#topa"), topaOptions);
                    topaChart.render();
                    console.log('Top asset chart rendered');
                } else {
                    console.error('Top asset chart element not found');
                }

            } catch (error) {
                console.error('Error rendering charts:', error);
                alert('Error rendering charts: ' + error.message);
            }
        }, 500);
    }
</script>
@endsection