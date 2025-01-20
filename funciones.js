function obtenerFechaHoy() {
    var fecha = new Date();
    var anio = fecha.getFullYear();
    var mes = ("0" + (fecha.getMonth() + 1)).slice(-2); 
    var dia = ("0" + fecha.getDate()).slice(-2); 
    return anio + "-" + mes + "-" + dia; 
}

function crearDataTable(idTable,visibilidad = true){
    $('#'+idTable).DataTable({
        paging: true,           
        order: [[1, 'asc']],     
        dom: 'ftip',              
        language: {              
            search: 'Buscar:',
            info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
            paginate: {
                next: 'Siguiente',
                previous: 'Anterior',
                infoEmpty: 'No hay registros disponibles',
            }
        },
        columnDefs: [
            {
                targets: 0, 
                visible: visibilidad 
            }
        ]
    });
}
function crearDatePicker(idDatePicker){
    $('#'+idDatePicker).datepicker({
        format: 'yyyy-mm-dd',     
        autoclose: true,         
        todayHighlight: true,     
        language: 'es',           
        weekStart: 1              
    });
}