@extends('layouts.admin-layout')
@section('page_title', 'Analytics')

@section('style')
<style>
    :root {
        --primary-color: #F96B23;
        --secondary-color: #666;
    }

    .--text-primary {
        color: var(--primary-color);
    }

    .--text-secondary {
        color: var(--secondary-color);
    }

    .text-xs {
        font-size: 10px;
    }

    .text-sm {
        font-size: 12px;
    }

    .text-base {
        font-size: 16px;
    }

    .text-xl {
        font-size: 24px;
    }

    .tracking-wide {
        letter-spacing: 0.2em;
    }

    .card-reduced-rounded {
        border-radius: 4px !important;
    }

    .card-reduced-shadow {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    table.monthly-earnings tr td {
        padding: 10px;
    }

    table.monthly-earnings tr td:nth-child(2),
    table.monthly-earnings tr td:nth-child(3),
    table.monthly-earnings tr td:nth-child(4) {
        text-align: right;
    }


    table.top-projects tr td {
        padding: 10px;
        font-size: 14px;
    }

</style>
@endsection

@section('content')
<div class="container">

    <h1 class="page-title ">Analytics</h1>

    <div class="card mt-4 p-3 px-4 card-reduced-rounded card-reduced-shadow">

        <h1 class="--text-primary fs-6">Monthly Earnings</h1>

        <div class="d-flex">
            <div class="border border-2 flex-grow-1 p-2 rounded" style="width: 45%;">
                <canvas id="line-chart" style="height: 300px; width: 100%;"></canvas>
            </div>

            <div class="flex-grow-1 px-4" style="width: 55%;">
                <table class="border-bottom border-2 monthly-earnings" style="width: 100%">
                    <tr>
                        <td class="text-sm --text-secondary" colspan="3">January</td>
                        <td colspan="1" class="text-base text-xl">
                            Month of May
                        </td>
                    </tr>
                    <tr>
                        <td class="text-sm --text-secondary">February</td>
                        <td class="text-base fw-semibold">PHP 500K</td>
                        <td class="text-sm --text-secondary">Week 1</td>
                        <td class="text-base ">PHP 100K</td>
                    </tr>
                    <tr>
                        <td class="text-sm --text-secondary">March</td>
                        <td class="text-base fw-semibold">PHP 500K</td>
                        <td class="text-sm --text-secondary">Week 1</td>
                        <td class="text-base ">PHP 500K</td>
                    </tr>
                    <tr>
                        <td class="text-sm --text-secondary">April</td>
                        <td class="text-base fw-semibold">PHP 730K</td>
                        <td class="text-sm --text-secondary">Week 1</td>
                        <td class="text-base ">PHP 200K</td>
                    </tr>
                    <tr>
                        <td class="text-sm --text-secondary">May</td>
                        <td class="text-base fw-semibold">PHP 900K</td>
                        <td class="text-sm --text-secondary">Week 1</td>
                        <td class="text-base ">PHP 100K</td>
                    </tr>
                </table>

                <h1 class="text-success fs-4 mt-3 tracking-wide" style="">TOTAL EARNINGS: PHP 3,050,000.00</h1>

            </div>
        </div>
    </div>

    <div class="card p-3 px-4 mt-4 d-flex card-reduced-rounded card-reduced-shadow">
        <table class="top-projects">
            <tr>
                <th class="--text-primary">Top Projects with Proposals</th>
                <th class="text-sm fw-lighter">No. of Proposals</th>
                <th class="--text-primary">Total Projects with Proposals</th>
            </tr>

            <tr>
                <td class="fw-bold">1. Construction Project by AL Constructions</td>
                <td class="fw-bold">530</td>
                <td class="fw-bold">1. AL Contructions</td>
            </tr>
            <tr>
                <td>2. Hotel Restructutre by MGM Hotels</td>
                <td class="">459</td>
                <td>2. MGM Hotels</td>
            </tr>
            <tr>
                <td>3. Airport Construction by AL Constructions</td>
                <td class="">450</td>
                <td>3. Karl Towns</td>
            </tr>
            <tr>
                <td>4. Construction Project by AL Constructions</td>
                <td class="">420</td>
                <td>4. AJ Supply</td>
            </tr>
        </table>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {

        const ctx = $("#line-chart")

        const labels = ["Jan", "Feb", "Mar", "Apr", "May"]
        const data = {
            labels: labels
            , datasets: [{
                label: ""
                , data: [200000, 490000, 580000, 700000, 950000]
                , fill: false
                , borderColor: 'rgb(75, 192, 192)'
                , backgroundColor: "rgb(125, 221, 244, 0.5)"
                , tension: 0.1
                , fill: true
                , borderWidth: 0
            , }]
        };

        new Chart(ctx, {
            type: 'line'
            , data
            , options: {
                scales: {
                    x: {
                        grid: {
                            display: false
                        , }
                    }
                    , y: {
                        grid: {
                            display: true, // Set to false to remove the horizontal gridlines
                        }
                        , ticks: {
                            callback: function(value) {
                                if (value >= 1000000) {
                                    value = value / 1000 / 1000 + "M"
                                } else if (value >= 1000) {
                                    value = value / 1000 + 'K'; // Format as kilo (thousand)
                                }
                                return value;
                            }
                        }
                    }
                }
                , elements: {
                    line: {
                        borderCapStyle: "butt"
                    }
                }
                , plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

    });

</script>

@endsection
