<script>
    $(function() {
        var donutChartCanvas = $('#donutUser').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Pending',
                'Approved',
                'Cancelled',
            ],
            datasets: [{
                data: [{{ count($ppending) }}, {{ count($papproved) }}, {{ count($pcancel) }}],
                backgroundColor: ['#ffc107', '#28a745', '#dc3545'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }

        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    });
</script>

<script>
    $(function() {
        var donutChartCanvas = $('#donutChecker').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Pending',
                'Approved',
                'Cancelled',
            ],
            datasets: [{
                data: [{{ count($pcheckerpending) }}, {{ count($pcheckerapproved) }}, {{ count($pcheckercancel) }}],
                backgroundColor: ['#ffc107', '#28a745', '#dc3545'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }

        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    });
</script>