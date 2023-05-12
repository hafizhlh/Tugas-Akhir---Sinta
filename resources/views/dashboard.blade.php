@extends('layouts.main')

@section('title', 'Dashboard')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Page Title-->
                    <span class="text-muted font-weight-bold mr-4">
                        <i class="fa fa-tachometer-alt text-warning"></i>
                    </span>
                    <!--end::Page Title-->
                    <!--begin::Actions-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                    <!--end::Actions-->
                </div>
                <div>
                    <span class="mr-2 d-none d-lg-inline text-dark my-auto" id="time"></span>
                </div>
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div id="chart"></div>
                        <div id="topc"></div>
                        <div id="topa"></div>
                    </div>
                </div>
              
            </div>
            <!--end::Container-->
        </div>
    </div>
@endsection

@section('js_page')

<script>
    $(document).ready(function() {
        // pie
        var pie = [];
        @foreach  ($pie as $p) 
          pie.push({{ $p->total }});
        @endforeach
        var options = {
          series: pie,
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['Asset', 'Consumable'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        // top consumable
        var topc = [];
        @foreach  ($topc as $c) 
          topc.push({{ $c->total }});
        @endforeach
        var topk = [];
        @foreach  ($topc as $c) 
          topk.push('{{ $c->nama_barang}}');
        @endforeach
        var optionsc = {
          series: [{
          name: 'Inflation',
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
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val + "%";
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },
        
        xaxis: {
          categories: topk,
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val + "%";
            }
          }
        
        },
        title: {
          text: 'Monthly Inflation in Argentina, 2002',
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        // top asset
        var topa = [];
        @foreach  ($topa as $a) 
          topa.push({{ $a->total }});
        @endforeach
        var tops = [];
        @foreach  ($topa as $a) 
          tops.push('{{ $a->nama_barang }}');
        @endforeach
        var optionsa = {
          series: [{
          name: 'Inflation',
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
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val + "%";
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },
        
        xaxis: {
          categories: tops,
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val + "%";
            }
          }
        
        },
        title: {
          text: 'Monthly Inflation in Argentina, 2002',
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };


        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        var topc = new ApexCharts(document.querySelector("#topc"), optionsc);
        topc.render();
        var topa = new ApexCharts(document.querySelector("#topa"), optionsa);
        topa.render();

    });
</script>
@endsection
