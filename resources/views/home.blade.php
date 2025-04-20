@extends('master')

@section('css')
<style>
    p {
        margin-bottom: 5px !important;
    }
</style>
@endsection

@section('body')
<div id="app">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">colección Rick and morty</a>
        </div>
    </nav>
    <div class="container">
        <div class="row" v-if="characters.length > 0">
            <div class="col-12 mt-3">
                <h2 class="text-center">Personajes</h2>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center rounded-3 bg-light p-3 mt-3 shadow">
                    <p class="fw-semibold">Quieres obtener y modificar 100 personajes</p>
                    <button class="btn btn-success" @click="getCharactersToStore()">Si, guardar</button>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xxl-3" v-for="character in characters" :key="character.id">
                <div class="card shadow mt-3 mx-auto" style="height: 460px;">
                    <img :src="character.image" class="card-img-top" :alt="character.name">
                    <div class="card-body d-flex flex-column">
                        <p class="card-title fw-bold lh-sm fs-5" style="height: 45px">@{{`${character.id} -
                            ${character.name}`}}</p>
                        <div class="d-flex justify-content-between">
                            <p :class="{
                                 'text-success': character.status === 'Alive',
                                 'text-danger': character.status === 'Dead',
                                 'text-secondary': character.status === 'unknown'
                            }">
                                Estado: @{{ character.status }}
                            </p>
                            <p>Especie: @{{ character.species }}</p>
                        </div>
                        <button class="btn btn-sm btn-primary  mt-auto align-self-end" type="button"
                            @click="getCharacter(character.id)" data-bs-toggle="offcanvas"
                            data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                            Ver mas detalles
                            <i class="fa-solid fa-eye ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex align-items-center justify-content-between">
                <b>total de personajes: @{{ paginate.total }}</b>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item">
                            <button class="page-link" aria-label="Previous" @click="prevPage()">
                                <span aria-hidden="true">&laquo;</span>
                            </button>
                        </li>
                        <li class="page-item">
                            <button class="page-link" aria-label="Next" @click="nextPage()">
                                <span aria-hidden="true">&raquo;</span>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div v-else class="d-flex m-5 justify-content-center">
            <div class="spinner-border text-info" style="width: 5rem; height: 5rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop"
        aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="staticBackdropLabel">Detalles del pesonaje</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div v-if="character">
                <div>
                    <img :src="character.image" class="img-fluid w-100" :alt="character.name">
                    <h2 class="my-2 text-center">@{{ character.name }}</h2>
                </div>
                <div class="">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th scope="row">Estado:</th>
                            <td>@{{ character?.status }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Especie:</th>
                            <td>@{{ character?.species }}</td>
                        </tr>
                        <tr>
                            <th scope="row">tipo:</th>
                            <td>@{{ character?.type }}</td>
                        </tr>
                        <tr>
                            <th scope="row">genero:</th>
                            <td>@{{ character?.gender }}</td>
                        </tr>
                        <tr>
                            <th scope="row">origen:</th>
                            <td><a :href="character?.origin?.url ">@{{ character?.origin?.name }}</a></td>
                        </tr>
                        <tr>
                            <th scope="row">ubicación:</th>
                            <td><a :href="character?.location?.url">@{{ character?.location?.name }}</a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div v-else class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
  
</div>

@endsection

@section('js')
<script>
    const { createApp, ref, reactive, onMounted, computed } = Vue

        createApp({
            setup() {
                const characters = ref([])
                const paginate = reactive({
                    currentPage: 1,
                    perPage: 20,
                    total: 0,
                })
                const character = ref(null)

                const getCharactersApi = async () => {
                    try {
                        const response = await fetch(`https://rickandmortyapi.com/api/character?page=${paginate.currentPage}`)
                        if (!response.ok) {
                            throw new Error('Fallo en la petición')
                        }
                        const data = await response.json()
                        characters.value = data.results
                        paginate.total = data.info.count
                    } catch (err) {
                       console.error('Error al obtener personajes:', err)
                    }
                }

                const getCharacters = async () =>
                {
                    try {
                        const response = await fetch('{{route('Character.getAll')}}', {
                            method: "GET",
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json",
                            },
                        });

                        if (!response.ok) {
                            throw new Error('Fallo en la petición')
                        }

                        const data = await response.json()
                        if(data.data.length === 0){
                            getCharactersApi()
                        }
                        characters.value = data.data
                        paginate.total = data.data.length
                    } catch (err) {
                       console.error('Error al obtener personajes:', err)
                    }
                }

                const nextPage = () => {
                    paginate.currentPage++
                    getCharacters()
                }

                const prevPage = () => {
                    if (paginate.currentPage > 1) {
                        paginate.currentPage--
                        getCharacters()
                    }
                }

                const getCharacter = async (id) => {
                    character.value = null
                    try {
                        const response = await fetch(`https://rickandmortyapi.com/api/character/${id}`)
                        if (!response.ok) {
                            throw new Error('Fallo en la petición')
                        }
                        const data = await response.json()
                        character.value = data
                     
                    } catch (error) {
                        console.error('Error al obtener personaje', error)
                    }
                }
  
                onMounted(() => {
                    getCharacters()
                })
                
                return {
                    characters,
                    getCharacter,
                    character,
                    nextPage,
                    prevPage,
                    paginate,
                }

            }
        }).mount('#app')
</script>
@endsection