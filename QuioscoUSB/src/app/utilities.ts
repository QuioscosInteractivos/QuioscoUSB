export class Utilities {

    ReplaceArrayItems (iarMenuArray, iarNewData){
        // Limpiando el arreglo
        iarMenuArray.length = 0;

        // Cambiando las opciones
        this.AddArrayItems(iarMenuArray, iarNewData);
    }

    // Agrega datos de un arreglo a otro.
    AddArrayItems (iarArray, iarData){
        // Agrega data solo si es enviada
        if (iarData) {
            iarArray.push.apply(iarArray, iarData);
        }
    }
}
