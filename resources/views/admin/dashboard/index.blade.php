@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h3 class="page__heading">Dashboard</h3>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h3 class="text-center">Dashboard Content</h3>
              <div>
                <canvas id="myChart" height="300vw" width="800vw">></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.2/dist/chart.min.js"></script>
  <script>
    var datasets = [];
    $.ajax({
      url: "/api/dashboard/get_chart_data",
      method: "GET",
    }).done(function(data) {
      console.log(data);

      data.chart_data.questions.forEach(dt => {
        datasets.push({
          // x: "Question ID " +dt.question_name,
          x: dt.question.question_name,
          y: dt.total
        })
      });

      console.log(datasets)

      const ctx = document.getElementById('myChart');
      const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          datasets: [{
            label: 'Total Errors',
            data: datasets,
            borderWidth: 1,
            backgroundColor: "#6777ef"
          }]
        },
      });
    })
  </script>
@endsection
