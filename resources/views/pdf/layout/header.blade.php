<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$reportTitle}} Report</title>
</head>
<style>

    body{
        font-family: sans-serif;
        
    }
    /* Table Styles */
    .table {
      border-collapse: collapse;
      width: 100%;
      font-size: 10px;
      border: 0.1px groove;
    }
    
    .table th,
    .table td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      border: 0.1px groove;

    }
    
    .table th {
      background-color: #f2f2f2;
    }
    .table tr {
    page-break-inside: avoid;
     }

      /* Header Styles */
   /* Header Styles */
   .header {
    height: 100px;
    background-color: #f2f2f2;
    padding: 10px;
    display: flex;
    align-items: center;
  }

  .logo {
    height: 60px;
    margin-right: 10px;
  }

  .company-name {
    font-size: 20px;
    font-weight: bold;
    margin-right: auto;
  }

  .report-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
  }

  .generated-on {
    font-size: 14px;
  }
  </style>
<body>
    <div class="header">
        {{-- <img class="logo" src="{{asset('website/img/logo.png')}}" alt="Company Logo" style="background: white;"> --}}
        <div>
          <div class="company-name">{{App\Models\About::first()->name}}</div>
          <div class="report-title">{{$reportTitle}}</div>
          <div class="generated-on">Generated on: <?php echo date('Y-m-d'); ?></div>
        </div>
      </div>