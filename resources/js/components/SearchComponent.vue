<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Búsqueda de vehiculos</div>

                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="modelyear">Año del vehiculo:</label>
                                        <input type="text" class="form-control" id="modelyear"  placeholder="Ingrese año del vehiculo (2015)">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="manucfaturer">Fabricante del vehiculo:</label>
                                        <input type="text" class="form-control" id="manucfaturer" placeholder="Ingrese el fabricante">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="model">Modelo del vehiculo:</label>
                                        <input type="text" class="form-control" id="model" placeholder="Ingrese el modelo">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="withrating">
                                        <label class="form-check-label" for="withrating">Con clasificación de choque?</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" style="float: right;" class="btn btn-primary">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
