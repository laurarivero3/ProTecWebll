</main>     
        <footer>
            <!-- place footer here 
            <h4>UPDS</h4> -->
            </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>

          <!-- paginacion con tablas  -->
        <script>
            $(document).ready( function(){
                $("#tabla_id").DataTable({
                    "pageLength":3,
                    lengthMenu:[
                        [3,10,25,50],
                        [3,10,25,50]       
                    ],
                    "language":{
                        "url":"https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
                    }
                });
            });

        </script>


        <script>
            function borrar(id){
                //alert(id);
                //swal, fire('Borrar...');
                Swal.fire({
                title: "¿Desea borrar el registro?",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Si",
                //denyButtonText: `Don't save`
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                //Swal.fire("Saved!", "", "success");
                window.location="index.php?txtID="+id;
                } 
                
                //else if (result.isDenied) {
                    //Swal.fire("Changes are not saved", "", "info");
                //}
                
                });
            }
        </script>

    </body>
</html>
