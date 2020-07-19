<template>
    <div class="container">
        <b-navbar toggleable type="dark">
            <b-navbar-brand href="/promociones/book/menu">Libros</b-navbar-brand>
            <b-navbar-toggle target="navbar-toggle-collapse">
                <template v-slot:default="{ expanded }">
                    <i v-if="expanded" class="fa fa-chevron-up"></i>
                    <i v-else class="fa fa-chevron-down"></i>
                </template>
            </b-navbar-toggle>

            <b-collapse id="navbar-toggle-collapse" is-nav>
                <b-navbar-nav class="ml-auto">
                    <b-nav-item-dropdown text="Tronco común">
                        <b-nav-item id="navDrop" href="/promociones/book/algebra-pro-20-1">
                            Álgebra</b-nav-item>
                        <b-nav-item id="navDrop" href="/promociones/book/biologia-pro-20-2">
                            Biología</b-nav-item>
                        <b-nav-item id="navDrop" href="/promociones/book/leo-y-e-1-pro-20-3">
                            LEO y E 1</b-nav-item>
                        <b-nav-item id="navDrop" href="/promociones/book/fisica-2-pro-20-4">
                            Física 2</b-nav-item>
                        <b-nav-item id="navDrop" href="/promociones/book/quimica-1-pro-20-5">
                            Química 1</b-nav-item>
                        <b-nav-item id="navDrop" href="/promociones/book/calculo-diferencial-pro-20-6">
                            Calculo Diferencial</b-nav-item>
                    </b-nav-item-dropdown>
                    <b-nav-item-dropdown text="English">
                        <b-nav-item id="navDrop" href="/promociones/book/plus-factor-1-pro-20-7">
                            Plus Factor 1</b-nav-item>
                        <b-nav-item id="navDrop" href="/promociones/book/plus-factor-2-pro-20-8">
                            Plus Factor 2</b-nav-item>
                        <b-nav-item id="navDrop" href="/promociones/book/plus-factor-3-pro-20-9">
                            Plus Factor 3</b-nav-item>
                        <b-nav-item id="navDrop" href="/promociones/book/plus-factor-4-pro-20-10">
                            Plus Factor 4</b-nav-item>
                        <b-nav-item id="navDrop" href="/promociones/book/plus-factor-5-pro-20-11">
                            Plus Factor 5</b-nav-item>
                        <b-nav-item id="navDrop" href="/promociones/book/english-aware-2-pro-20-12">
                            English Aware 2</b-nav-item>
                        <b-nav-item id="navDrop" href="/promociones/book/english-aware-4-pro-20-13">
                            English Aware 4</b-nav-item>
                    </b-nav-item-dropdown>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>