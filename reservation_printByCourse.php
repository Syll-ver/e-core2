<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Course Reservation Print</title>
    
    <style>
    .invoice-box{
        max-width:1000px;
        margin:auto;
        padding:20px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:18px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:10px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:30px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
                     
                    <h4 align="center"> MSU General Santos Online Course Reservation List for (course)</h4>

        <table border="1" cellspacing="0" cellpadding="5">
            <tr class="top">
                
                        <tr>
                            
                                <th width="5%">#</th>
                               <th width="15%">Student ID No.</th>
                                <th width="20%">Student Name</th>
                                <th width="5%">Student Track</th>
                                <th width="10%">Course Name</th>
                                <th width="10%">College</th>
                                <th width="10%">Department</th>
                                <th width="20%">Student Course Reservation Date:</th> 
                                <th width="10%">Status</th> 
                        </tr>
                    
               
            </tr>
 
    
            <tr>
                <td> </td>
                <td> </td>
                <td> ></td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> ></td>
                <td> </td>
</tr>
           
 
          
            
         
        </table>

        <h4 align="center"> Waitlisters for <?php echo $course; ?></h4>

        <table border="1" cellspacing="0" cellpadding="5">
            <tr class="top">
                
                        <tr>
                            
                                <th width="5%">#</th>
                               <th width="15%">Student ID No.</th>
                                <th width="20%">Student Name</th>
                                <th width="5%">Student Track</th>
                                <th width="10%">Course Name</th>
                        </tr>
                    
               
            </tr>
 
    
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                
                <td> </td>
</tr>
           
          
            
         
        </table>
       
    </div>
</body>
</html>