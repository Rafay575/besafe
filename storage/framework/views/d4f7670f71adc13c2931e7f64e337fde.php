<!DOCTYPE html>
<html lang="en">

<head>
  <?php echo $__env->make('layouts.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('layouts.partials.core_style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->yieldContent('style'); ?>
  <link href="<?php echo e(asset('assets/css/custom.css')); ?>?v=<?php echo e(time()); ?>" rel="stylesheet">



</head>

<body class="g-sidenav-show bg-white-custom" style="background-color:#F7F7F7">

  
  <!-- <div id="main_loading" class=" bg-primary position-fixed w-100 h-100 d-block " style="z-index: 100; top:0; left:0; text-align: center;opacity: 0.5;z-index:999999">
        <img width="80px" src="<?php echo e(asset('website/img/loader.gif')); ?>" alt="loading"
        style="
        position: absolute;
          top: 36%;
          left: 45%;
          z-index: 100;
        "
        >
        <div class="spinner-grow text-danger"  role="status" style="
        position: absolute;
          top: 37%;
          left: 45%;
          z-index: 100;
          width: 5rem; height: 5rem;
        " >
          <span class="sr-only">Loading...</span>
        </div>
      </div> -->
  


  <?php echo $__env->make('layouts.partials.site_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <main class="main-content position-relative border-radius-lg">
    <!-- Navbar -->
    <?php echo $__env->make('layouts.partials.header_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End Navbar -->
    
    <div class="container-fluid py-4">
      <?php echo $__env->yieldContent('content'); ?>
      <?php echo $__env->make('layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    
    

  </main>
  <?php echo $__env->make('layouts.partials.ui_change', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!--   Core JS Files   -->
  <?php echo $__env->make('layouts.partials.core_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->yieldContent('script'); ?>

</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // hide loadin
  $(window).on('load', function () {
    $('div#main_loading').removeClass('d-block');
    $('div#main_loading').addClass('d-none');
  });
  const ctx1 = document.getElementById("ticketChart").getContext("2d");
  const labels = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  const openTicketsData = [22, 46, 22, 25, 55, 69, 86, 80, 61, 42, 29, 10];
  const closedTicketsData = [19, 23, 35, 48, 2, 23, 2, 26, 32, 23, 23, 7];
  const progressTicketsData = [3, 18, 13, 15, 30, 30, 50, 20, 7, 0, 33, 26];
  const reviewTicketsData = [11, 32, 11, 47, 27, 3, 34, 40, 42, 16, 4, 32];

  new Chart(ctx1, {
    type: "line",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Open Ticket",
          data: openTicketsData,
          backgroundColor: "rgba(37,111,34, 0.1)",
          borderColor: "rgba(37,111,34, 1)",
          borderWidth: 2,
          fill: true,
          tension: 0.4,
        },
        {
          label: "Closed ",
          data: closedTicketsData,
          backgroundColor: "rgba(51,49,50, 0.1)",
          borderColor: "rgba(51,49,50, 1)",
          borderWidth: 2,
          fill: true,
          tension: 0.4,
        },
        {
          label: "In Progress ",
          data: progressTicketsData,
          backgroundColor: "rgba(222,180,16, 0.1)",
          borderColor: "rgba(222,180,16, 1)",
          borderWidth: 2,
          fill: true,
          tension: 0.4,
        },
        {
          label: "Feedback ",
          data: reviewTicketsData,
          backgroundColor: "rgba(253,97,0, 0.1)",
          borderColor: "rgba(253,97,0, 1)",
          borderWidth: 2,
          fill: true,
          tension: 0.4,
        },
      ],
    },
    options: {
      scales: {
        x: {
          beginAtZero: true
        },
        y: {
          beginAtZero: true,
          max: 100,
          title: {
            display: true,
            text: "Tickets",
          },
        },

      },
    },
  });

  const pieLabelsLine = {
    id: "pieLabelsLine",
    afterDraw(chart) {
      const {
        ctx,
        chartArea: { width, height, top, left },
      } = chart;
      const cx = left + width / 2;
      const cy = top + height / 2;
      const sum = chart.data.datasets[0].data.reduce((a, b) => a + b, 0);

      chart.data.datasets.forEach((dataset, i) => {
        chart.getDatasetMeta(i).data.forEach((datapoint, index) => {
          const { x: a, y: b } = datapoint.tooltipPosition();
          const outerRadius = datapoint.outerRadius;
          const x =
            cx +
            ((a - cx) /
              Math.sqrt(Math.pow(a - cx, 2) + Math.pow(b - cy, 2))) *
            outerRadius;
          const y =
            cy +
            ((b - cy) /
              Math.sqrt(Math.pow(a - cx, 2) + Math.pow(b - cy, 2))) *
            outerRadius;
          const halfwidth = width / 2;
          const halfheight = height / 2;
          const xLine = x >= halfwidth ? x + 10 : x - 10;
          const yLine = y >= halfheight ? y + 10 : y - 10;
          const extraLine = x >= halfwidth ? 10 : -10;
          ctx.beginPath();
          ctx.moveTo(x, y);
          ctx.fill();
          ctx.moveTo(x, y);
          ctx.lineTo(xLine, yLine);
          ctx.lineTo(xLine + extraLine, yLine);
          ctx.strokeStyle = dataset.backgroundColor[index]; // Change color if needed
          ctx.lineWidth = 1.5;
          ctx.stroke();
          const percentage =
            ((chart.data.datasets[0].data[index] * 100) / sum).toFixed(
              2
            ) + "%";
          ctx.font = "10px Arial";
          const textXPosition = x >= halfwidth ? "left" : "right";
          const plusFivePx = x >= halfwidth ? 5 : -5;
          ctx.textAlign = textXPosition;
          ctx.textBaseline = "middle";
          ctx.fillStyle = dataset.backgroundColor[index]; // Change color if needed

          ctx.fillText(percentage, xLine + extraLine + plusFivePx, yLine);
        });
      });
    },
  };

  const ctx = document.getElementById("myChart").getContext("2d");
  const myChart = new Chart(ctx, {
    type: "doughnut",
    data: {
      labels: ["Red", "Blue", "Yellow", "Green"],
      datasets: [
        {
          label: " of Votes",
          data: [12, 19, 3, 5],
          backgroundColor: [
            "rgb(45, 206, 137)",
            "rgb(17, 205, 239)",
            "rgb(120, 0, 255)",
            "rgb(251, 99, 64)",
          ],
          borderColor: [
            "rgb(45, 206, 137)",
            "rgb(17, 205, 239)",
            "rgb(120, 0, 255)",
            "rgb(251, 99, 64)",
          ],
          borderWidth: 1,
          cutout: "80%",
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        },
      },
      layout: {
        padding
        :{
          top:10,
          right:10,
          left:10,
          bottom:10,
        }
      },
    },
    plugins: [pieLabelsLine], // Adding your custom plugin
  });
  const ctx2 = document.getElementById("myDoughnutChart").getContext("2d");
  const myDoughnutChart = new Chart(ctx2, {
    type: "doughnut",
    data: {
      labels: ["Python", "Java", "JavaScript", "C#", "Others"],
      datasets: [
        {
          label: "Programming Languages",
          data: [30, 17, 10, 7, 36],
          backgroundColor: [
            "rgb(10, 58, 169)",
            "rgb(45, 206, 137)",
            "rgb(17, 205, 239)",
            "rgb(120, 0, 255)",
            "rgb(251, 99, 64)",
          ],
          borderColor: [
            "rgb(10, 58, 169)",
            "rgb(45, 206, 137)",
            "rgb(17, 205, 239)",
            "rgb(120, 0, 255)",
            "rgb(251, 99, 64)",
          ],
          borderWidth: 1,
          cutout: "80%",
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 0,
          right: 0,
          top: 0,
          bottom: 0,
        },
      },
      plugins: {
        legend: {
          display: false, // Hide the default legend
        },
      },
      layout: {
        padding
        :{
          top:10,
          right:10,
          left:10,
          bottom:10,
        }
      },
    },
  });

</script><?php /**PATH C:\wamp64\www\flexi\resources\views/layouts/main.blade.php ENDPATH**/ ?>