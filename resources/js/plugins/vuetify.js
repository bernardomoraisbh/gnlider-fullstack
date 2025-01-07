import "@mdi/font/css/materialdesignicons.css";
import "vuetify/styles";

import { VDateInput } from 'vuetify/labs/VDateInput'

import { createVuetify } from "vuetify";
import * as directives from "vuetify/directives";
import { pt, en } from 'vuetify/locale'

export default createVuetify({
    locale: {
        locale: 'pt',
        fallback: 'en',
        messages: { pt, en },
    },
    theme: {
        defaultTheme: "dark",
    },
    components: {
        VDateInput,
    },
    directives,
});
