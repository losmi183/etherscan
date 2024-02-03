// Vuetify Documentation https://vuetifyjs.com

// Vuetify
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

// import logoDark from '../assets/img/logo-dark.png'
// import logoLight from '../assets/img/logo-light.png'
import logoDark from '../assets/img/RetailCITIES-logo-slim-dark.png'
import logoLight from '../assets/img/RetailCITIES-logo-slim.png'

import modeDark from '../assets/icon/icons8-light-100.png'
import modeLight from '../assets/icon/icons8-light-off-100.png'

export default createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: "light",
        themes: {
            light: {
                logo: logoLight,
                modeIcon: modeLight,
                dark: false,
                colors: {
                    canvas: "#ffffff",
                    primary: "#A7D397",
                    primaryone: "#164863",
                    success: "#A7D397",
                    "page-header-background": "#FAEBD7",
                    "page-background": "#FFFBF5",
                    "table-header": "#cdcdc1",
                    background: "#FFFBF5",
                    // background: "#ffffff",
                    surface: "#FAEBD7",
                    "header-background": "#FFFBF5",
                    "info-text": "#666660",
                    accent: "#A7D397",
                    alert: "#CD4238",
                    error: "#F05454",
                    info: "#3876BF",
                    orange: "#EF4D43",
                    indigo: "#233242",
                    font: "#233242",
                    grey: "#F5F1EB",
                },
            },
            dark: {
                logo: logoDark,
                modeIcon: modeDark,
                dark: true,
                colors: {
                    canvas: "#5f666d",
                    primary: "#A7D397",
                    primaryone: "#F4CE14",
                    success: "#A7D397",
                    "page-header-background": "#30373E",
                    "page-background": "#30373E",
                    "table-header": "#30373E",
                    background: "#222F3E",
                    surface: "#30373E",
                    "header-background": "#30373E",
                    "info-text": "#99999F",
                    accent: "#F99417",
                    alert: "#CD4238",
                    error: "#F05454",
                    info: "#3876BF",
                    orange: "#EF4D43",
                    indigo: "#0F4C75",
                    font: "#FFFBF5",
                    grey: "#2B3746",
                },
            },
        },
    },
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
        mdi,
        },
    },
})
