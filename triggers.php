<?php
include('con.php');

$dropTriggers ="
DROP TRIGGER IF EXISTS afterProductoInsert;
DROP TRIGGER IF EXISTS beforeProductoUpdate;
DROP TRIGGER IF EXISTS beforeProductoDelete;
";

if ($con->multi_query($dropTriggers)) {
    do {
        if ($con->more_results()) {
            $con->next_result();
        }
    } while ($con->more_results());
    //echo "Triggers existentes eliminados correctamente.<br>";
} else {
    //echo "Error eliminando los triggers existentes: " . $con->error . "<br>";
}

$sqlBitacora = "
CREATE TABLE IF NOT EXISTS bitacora(
    idLog INT AUTO_INCREMENT PRIMARY KEY,
    operacion VARCHAR(255),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    admin VARCHAR(255), 
    sentencia TEXT, 
    contrasentencia TEXT
);
";

if($con->query($sqlBitacora) === TRUE){

}else{

}

// $sqlProcedure = "
// CREATE PROCEDURE registrarBitacora(
//     IN p_operacion VARCHAR(255),
//     IN p_admin VARCHAR(255),
//     IN p_sentencia TEXT,
//     IN p_contrasentencia TEXT
// )
// BEGIN
//     INSERT INTO bitacora (operacion, admin, sentencia, contrasentencia)
//     VALUES (p_operacion, p_admin, p_sentencia, p_contrasentencia);
// END;
// ";

// if($con->query($sqlProcedure)){
//     do{
//         if($con->more_results()){
//             $con->next_result();
//         }
//     }while($con->more_results());
// }else{

// }

$sqlTriggerInsert="
CREATE TRIGGER afterProductoInsert 
AFTER INSERT ON producto
FOR EACH ROW
BEGIN
    INSERT INTO bitacora (operacion, admin, sentencia, contrasentencia)
    VALUES (
        'INSERT', 
        USER(), 
        CONCAT('INSERT INTO producto(nombreProducto, precioProducto, colorProducto, imagenProducto, descripcionProducto, materialProducto, popularProducto) VALUES(\'', NEW.nombreProducto, '\', ', NEW.precioProducto, ', \'', NEW.colorProducto, '\', \'', NEW.imagenProducto, '\', \'', NEW.descripcionProducto, '\', \'', NEW.materialProducto, '\', ', NEW.popularProducto, ')'),
        CONCAT('DELETE FROM producto WHERE idProducto = ', NEW.idProducto)
    );
END;
";

$sqlTriggerUpdate="
CREATE TRIGGER beforeProductoUpdate
BEFORE UPDATE ON producto
FOR EACH ROW
BEGIN
    INSERT INTO bitacora (operacion, admin, sentencia, contrasentencia)
    VALUES (
        'UPDATE', 
        USER(), 
        CONCAT('UPDATE producto SET nombreProducto = \'', NEW.nombreProducto, '\', precioProducto = ', NEW.precioProducto, ', colorProducto = \'', NEW.colorProducto, '\', imagenProducto = \'', NEW.imagenProducto, '\', descripcionProducto = \'', NEW.descripcionProducto, '\', materialProducto = \'', NEW.materialProducto, '\', popularProducto = ', NEW.popularProducto, ' WHERE idProducto = ', OLD.idProducto),
        CONCAT('UPDATE producto SET nombreProducto = \'', OLD.nombreProducto, '\', precioProducto = ', OLD.precioProducto, ', colorProducto = \'', OLD.colorProducto, '\', imagenProducto = \'', OLD.imagenProducto, '\', descripcionProducto = \'', OLD.descripcionProducto, '\', materialProducto = \'', OLD.materialProducto, '\', popularProducto = ', OLD.popularProducto, ' WHERE idProducto = ', OLD.idProducto)
    );
END;
";

$sqlTriggerDelete="
CREATE TRIGGER beforeProductoDelete
BEFORE DELETE ON producto
FOR EACH ROW
BEGIN
    INSERT INTO bitacora (operacion, admin, sentencia, contrasentencia)
    VALUES (
        'DELETE',
        USER(),
        CONCAT('DELETE FROM producto WHERE idProducto = ', OLD.idProducto),
        CONCAT('INSERT INTO producto(nombreProducto, precioProducto, colorProducto, imagenProducto, descripcionProducto, materialProducto, popularProducto) VALUES(\'', OLD.nombreProducto, '\', ', OLD.precioProducto, ', \'', OLD.colorProducto, '\', \'', OLD.imagenProducto, '\', \'', OLD.descripcionProducto, '\', \'', OLD.materialProducto, '\', ', OLD.popularProducto, ')')
    );
END;

";

if($con->query($sqlTriggerInsert) === TRUE){
    //echo "Trigger afterProductoInsert creado correctamente.<br>";
} else {
    //echo "Error al crear el trigger afterProductoInsert: " . $con->error . "<br>";
}

if($con->query($sqlTriggerUpdate) === TRUE){
    //echo "Trigger beforeProductoUpdate creado correctamente.<br>";
} else {
    //echo "Error al crear el trigger beforeProductoUpdate: " . $con->error . "<br>";
}

if($con->query($sqlTriggerDelete) === TRUE){
    //echo "Trigger beforeProductoDelete creado correctamente.<br>";
} else {
    //echo "Error al crear el trigger beforeProductoDelete: " . $con->error . "<br>";
}

?>