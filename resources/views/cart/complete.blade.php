<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        body{
            font-family: "Garuda", sans-serif;
        }
        table tr th{
            padding: 5px;
            background-color: #f7f7f7;
        }
        table tr td{
            padding: 5px;
        }
    </style>
</head>
<body>

<table border="0" width="100%">
    <tr>
        <td colspan="2" align="center"><h1> ใบสั่งซื้อ </h1><h2> (Purchase Order) </h2> </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%">
                <tr>
                    <td><strong> ชื่อลูกค้า  </strong> </td>
                    <td> {{ $cust_name}} </td>
                </tr>  
                <tr>
                    <td><strong> อีเมล </strong> </td>
                    <td> {{ $cust_email}} </td>
                </tr>   
            </table>
        </td>
        <td>
            <table border="0" width="100%">
                <tr>
                    <td><strong> เลขที่ :   </strong> </td>
                    <td> {{ $po_no}} </td>
                </tr>  
                <tr>
                    <td><strong> วันที่ : </strong> </td>
                    <td> {{ $po_date}} </td>
                </tr>   
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table border="1" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <th> ลำดับ</th>
                    <th> ชื่อสินค้า </th>
                    <th> ราคา/หน่วย  </th>
                    <th> จำนวน </th>
                    <th> รวมเงินห </th>
                </tr>
                @foreach ($cart_items as $c)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $c['name'] }} </td>
                        <td align="right"> {{ number_format($c['price'],0) }} </td>
                        <td align="right"> {{ number_format($c['qty'],0) }} </td>
                        <td align="right"> {{ number_format($c['price']*$c['qty'],0) }} </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <h4> หมายเหตุ </h4>
            <ul>
                <li> ชำระเงินโดยโอนเข้าบัญชี XXX ธนาคาร YYY สาขา ZZZ (ออมทรัพย์) </li>
                <li> กรุณาชำระเงินภายใน 7 วัน หลังจากการสั่งซื้อ </li>
                <li> ชำระเงินแล้วส่งหลักฐานมาที่ sale"bikeshop.com หรือ LINE : bikeshop </li>
            </ul>
        </td>
        <td align="right">
            <strong> จำนวนเงินรวมทั้งสิ้น </strong>
            <h1> {{ $total_amount}} บาท </h1>
        </td>
    </tr>
</table>
</body>
</html>