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
                    {{-- @foreach ($month as $months)
                      <p>{{ $months }}</p>
                    @endforeach --}}
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
              <div class="row hidden-md-up">
                <div class="col-md-6 col-lg-6">
                  <div class="card mb-4">
                    <div class="card">
                      <div class="card-body">
                        <h3 class="card-title">Jenis Barang</h3>
                          <div id="chart"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6">
                  <div class="card mb-4">
                    <div class="card">
                      <div class="card-body">
                        <h3 class="card-title">Permintaan Consumable & Aset</h3>
                          <div id="chartb"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6">
                  <div class="card mb-4">
                    <div class="card">
                      <div class="card-body">
                        <h3 class="card-title">Top 5 Barang Aset</h3>
                          <div id="topa"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6">
                  <div class="card mb-4">
                    <div class="card">
                      <div class="card-body">
                        <h3 class="card-title">Top 5 Barang Consumable</h3>
                          <div id="topc"></div>
                      </div>
                    </div>
                  </div>
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
        // Jenis Barang
        var pie = [];
        @foreach  ($pie as $p) 
          pie.push({{ $p->total }});
        @endforeach
        var options = {
          colors: ['#2196F3', '#FF1654'],
          series: pie,
          chart: {
          width: 530,
          type: 'pie',
        },
        labels: ['Asset', 'Consumable'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 580
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        // Top 5 Barang Consumable
        var topc = [];
        @foreach  ($topc as $c) 
          topc.push({{ $c->total }});
        @endforeach
        var topk = [];
        @foreach  ($topc as $c) 
          topk.push('{{ $c->nama_barang}}');
        @endforeach
        var optionsc = {
          colors: ['#FF1654'],
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

        // Top 5 Barang Aset
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

        // Permintaan Consummabl & Aset
        var month = [];
        var consumables = [];
        var assets = [];
        @foreach ($month as $m)
          month.push('{{ $m['month'] }}');
          consumables.push({{ $m['consumables'] }});
          assets.push({{ $m['assets'] }}); 
        @endforeach
        var optionsb = {
          series: [{
            name: "Consumables",
            data: consumables
        },
        {
            name: "Assets",
            data: assets
        }
      ],
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
        colors: ['#FF1654', '#2196F3'],
        stroke: {
          curve: 'straight'
        },
        title: {
          text: 'Product Trends by Month',
          align: 'left'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: month,
        }
        };


        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        var topc = new ApexCharts(document.querySelector("#topc"), optionsc);
        topc.render();
        var topa = new ApexCharts(document.querySelector("#topa"), optionsa);
        topa.render();
        var chartb = new ApexCharts(document.querySelector("#chartb"), optionsb);
        chartb.render();

    });
</script>
@endsection
