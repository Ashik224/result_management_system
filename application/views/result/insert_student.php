<!DOCTYPE html>
<html>
<head>
	<title>Insert student info</title>
  <link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>"> 
  <script type = "text/javascript" src="<?php echo base_url('/js/jquery-3.js') ?>" > </script>
</head>
<body>

  <div id = "content" class="" align="center">
      <input type="file" id="fileUpload" />
      <input type="button" id="upload" value="Upload" onclick="Upload()" />
      <div id="dvExcel"></div>
  </div>

	<div class="container" align="center">
		<?php echo form_open('Result_Controller/get_student_new'); ?>
  <div class="col-sm-2">
    <label>ID</label>
    <input type="text" class="form-control" name = "id" placeholder="Add ID">
</div>
<br>
	<div class="col-sm-2">
    <label>Registration</label>
    <input type="text" class="form-control" name = "registration" placeholder="Add Registration">
</div>
<br>
<div class="col-sm-2">
    <label>Name</label>
    <input type="text" class="form-control" name = "name" placeholder="Add Name">
</div>
<br>
<div class="col-sm-2">
    <label>Session</label>
    <input type="text" class="form-control" name = "session" placeholder="Add Session">
</div>
<br>
<div class="col-sm-2">
    <label>Subject</label>
    <input type="text" class="form-control" name = "subject" placeholder="Add Subject">
  </div>
<br>
  <div class="col-sm-2">
    <label>Degree</label>
    <input type="text" class="form-control" name = "degree" placeholder="Add Degree">
  </div> 
<br>
  
  <button type="submit" class="btn btn-primary">Insert</button>
</form>
</div>  

<script type = "text/javascript" src="<?php echo base_url('/js/jquery-3.js') ?>" > </script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
</body>
</html>

<script type = "text/javascript">

 function Upload() {
        //Reference the FileUpload element.
        var fileUpload = document.getElementById("fileUpload");
 
        //Validate whether File is valid Excel file.
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (FileReader) != "undefined") {
                var reader = new FileReader();
 
                //For Browsers other than IE.
                if (reader.readAsBinaryString) {
                    reader.onload = function (e) {
                        ProcessExcel(e.target.result);
                    };
                    reader.readAsBinaryString(fileUpload.files[0]);
                } else {
                    //For IE Browser.
                    reader.onload = function (e) {
                        var data = "";
                        var bytes = new Uint8Array(e.target.result);
                        for (var i = 0; i < bytes.byteLength; i++) {
                            data += String.fromCharCode(bytes[i]);
                        }
                        ProcessExcel(data);
                    };
                    reader.readAsArrayBuffer(fileUpload.files[0]);
                }
            } else {
                alert("This browser does not support HTML5.");
            }
        } else {
            alert("Please upload a valid Excel file.");
        }
    };
    function ProcessExcel(data) {
        //Read the Excel File data.
        var workbook = XLSX.read(data, {
            type: 'binary'
        });
 
        //Fetch the name of First Sheet.
        var firstSheet = workbook.SheetNames[0];
 
        //Read all rows from First Sheet into an JSON array.
        var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);
 
 
        //Add the data rows from Excel file.
        var id = [];
        var registration = [];
        var name = [];
        var session = [];
        var active_session = [];
        var subject = [];
        var degree = [];
        
        for (var i = 0; i < excelRows.length; i++) {
             id[i] = excelRows[i].ID;
             registration[i] = excelRows[i].Registration;
             name[i] = excelRows[i].Name;
             session[i] = excelRows[i].Session;
             active_session[i] = excelRows[i].Active_session;
             subject[i] = excelRows[i].Subject;
             degree[i] = excelRows[i].Degree;

        } 

      //  alert(degree[0]);

        $.ajax({
              url: "<?php echo base_url();?>/Result_Controller/parse_excel_for_student",
              type: 'POST',
              data: {id:id,registration:registration,name:name,session:session,active_session:active_session,subject:subject,degree:degree},
              dataType: 'html',    
              success: function(data) {
                 $('#content').html(data);
              }   
             // alert('po');
        }); 
 
        var dvExcel = document.getElementById("dvExcel");
        dvExcel.innerHTML = "";
      //  dvExcel.appendChild(table);
}; 


</script>
