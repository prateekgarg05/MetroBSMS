<!DOCTYPE html>
<html>
    <head>
        <title>Report</title>
        <style type="text/css">
            table {
	    border-right:0;
	    clear: both;
	    color: #333;
	    margin-bottom: 10px;
	    width: 100%;
    }
    th {
	    border:0;
	    border-bottom:2px solid #555;
	    text-align: left;
	    padding:4px;
    }
    th a {
	    display: block;
	    padding: 2px 4px;
	    text-decoration: none;
    }

    table tr td {
	    padding: 6px;
	    text-align: left;
	    vertical-align: top;
	    border-bottom:1px solid #ddd;
    }
    table tr:nth-child(even) {
	    background: #f9f9f9;
    }
    td.actions {
	    text-align: center;
	    white-space: nowrap;
    }
    table td.actions a {
	    margin: 0px 6px;
	    padding:2px 5px;
    }
        </style>
    </head>
    <body>
        <img src="http://bsms.us/img/site/logo.png" alt=".">   
        <table>
            <tr>
                <td><b>Bus Stop</b></td>
                <td><b>Answer</b></td>
            </tr>
    
            <?php for($i=0;$i<count($data['stops']);$i++):?>
             <tr>
                <td><?php echo $data['stops'][$i];?></td>
                <td><?php echo $data['answers'][$i];?></td>
              </tr>
             <?php endfor;?>
        </table>
    </body>
</html>