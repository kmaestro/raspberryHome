<template>
    <nav class="navbar orange lighten-1">
        <div class="nav-wrapper">
        <div class="navbar-left">
            <a href="#" @click.prevent="$emit('click')">
                <i class="material-icons black-text">dehaze</i>
            </a>
            <span class="black-text">{{date | date('datetime')}}</span>
            <span class="black-text" style="margin-left: 30px"> CPU: {{CPU.temp}} &#8451;</span>
        </div>

        <ul class="right hide-on-small-and-down">
            <li>
                <a
                        class="dropdown-trigger black-text"
                        href="#"
                        data-target="dropdown"
                >
                    USER NAME
                    <i class="material-icons right">arrow_drop_down</i>
                </a>

                <ul id='dropdown' class='dropdown-content'>
                    <li>
                        <a href="#" class="black-text">
                            <i class="material-icons">account_circle</i>Профиль
                        </a>
                    </li>
                    <li class="divider" tabindex="-1"></li>
                    <li>
                        <a href="#" class="black-text">
                            <i class="material-icons">assignment_return</i>Выйти
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    </nav>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "Navbar",
        data: () => ({
            date: new Date(),
            interval: null,
            CPU: {
                temp: null
            }
        }),
        mounted() {
            this.interval = setInterval(() => {
                this.date = new Date()
                axios.get('http://api.home.loc').then((response) => {
                    this.CPU.temp = response.data.temperature
                })

            }, 1000)
        },
        beforeDestroy() {
            clearInterval(this.interval)
        }
    }
</script>

<style scoped>

</style>