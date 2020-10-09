@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
@endsection

@push('js')
<script>
    var chart_1_label = ['M', 'T', 'W', 'T', 'F', 'S', 'S']
    var chart_1_series = [
        [12, 17, 7, 17, 23, 18, 38]
        ]

    var chart_2_label = ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D']
    var chart_2_series = [
          [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]
        ]
    var chart_3_label = ['12p', '3p', '6p', '9p', '12p', '3a', '6a', '9a']
    var chart_3_series = [
          [230, 750, 450, 300, 280, 240, 200, 190]
        ]
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts(chart_1_label,chart_1_series,chart_2_label,chart_2_series,chart_3_label,chart_3_series);
    });
</script>
@endpush
