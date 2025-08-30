<div 
    x-data="autocomplete({
        fetchUrl: '/api/search',
        valueField: 'id',
        labelField: 'name',
        onSelect: (item) => { console.log('Seleccionado:', item) }
    })"
    class="relative"
>
    <input 
        type="text" 
        x-model="query" 
        @input="search()" 
        placeholder="Buscar..."
        class="border px-2 py-1 w-full"
    >

    <ul 
        x-show="open" 
        class="absolute bg-white border mt-1 w-full z-10 max-h-40 overflow-y-auto"
    >
        <template x-for="item in results" :key="item[valueField]">
            <li 
                @click="select(item)"
                class="px-2 py-1 hover:bg-gray-100 cursor-pointer"
                x-text="item[labelField]"
            ></li>
        </template>
    </ul>
</div>

<script>
function autocomplete({ fetchUrl, valueField, labelField, onSelect }) {
    return {
        query: '',
        results: [],
        open: false,

        async search() {
            if (this.query.length < 2) {
                this.results = [];
                this.open = false;
                return;
            }

            let response = await fetch(`${fetchUrl}?q=${encodeURIComponent(this.query)}`);
            this.results = await response.json();
            this.open = true;
        },

        select(item) {
            this.query = item[labelField];
            this.open = false;
            if (typeof onSelect === 'function') {
                onSelect(item);
            }
        }
    }
}
</script>
