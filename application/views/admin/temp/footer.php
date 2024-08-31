 <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2019</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
<script language="JavaScript">
/**
  * Disable mouse right-click on page
  * By Arthur Gareginyan (arthurgareginyan@gmail.com)
  * For full source code, visit http://www.mycyberuniverse.com
  */
  function exportTableToExcel(tableID, filename = ''){
      var downloadLink;
      var dataType = 'application/vnd.ms-excel';
      var tableSelect = document.getElementById(tableID);
      var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';
        
        // Create download link element
        downloadLink = document.createElement("a");
        
        document.body.appendChild(downloadLink);
        
        if(navigator.msSaveOrOpenBlob){
          var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
          });
          navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;
            
            //triggering the function
            downloadLink.click();
          }
    }
    
document.addEventListener("contextmenu", function(e){
    e.preventDefault();
}, false);
$(document).ready( function () {
    $('#dataTable').DataTable();
} );

$(document).ready( function () {
    $('#dataTable1').DataTable();
} );

</script>
    </body>
</html>
