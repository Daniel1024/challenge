<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Búsqueda de vehiculos</div>

                    <div class="card-body">
                        <form @submit.prevent="search">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="modelyear">Año del vehiculo:</label>
                                        <input type="text" v-model="model_year" class="form-control" id="modelyear"  placeholder="Ingrese año del vehiculo (2015)">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="manufacturer">Fabricante del vehiculo:</label>
                                        <input type="text" v-model="manufacturer" class="form-control" id="manufacturer" placeholder="Ingrese el fabricante">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="model">Modelo del vehiculo:</label>
                                        <input type="text" v-model="model" class="form-control" id="model" placeholder="Ingrese el modelo">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-check">
                                        <input type="checkbox" v-model="withrating" class="form-check-input" id="withrating">
                                        <label class="form-check-label" for="withrating">Con clasificación de choque?</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" style="float: right;" class="btn btn-primary">Buscar</button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <div class="list-group">
                            Cantidad de resultados: {{ count }}
                            <div v-for="value in results" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">ID: {{ value.VehicleId }}</h5>
                                </div>
                                <p class="mb-1">Descripción: {{ value.Description }}</p>
                                <small v-if="value.CrashRating">Clasificación de choque: {{ value.CrashRating }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                model_year: '2015',
                manufacturer: 'Audi',
                model: 'A3',
                count: 0,
                withrating: false,
                results: []
            }
        },
        methods: {
            search() {
                let ruta = `/vehicles/${this.model_year}/${this.manufacturer}/${this.model}`;
                window.axios.get(ruta, {
                    params: {
                        withRating: this.withrating
                    }
                }).then((response) => {
                    this.count = response.data.Count;
                    this.results = response.data.Results;
                }).catch((error) => {
                    console.error(error);
                });
            }
        }
    }
</script>
