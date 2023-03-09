<template>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">

<div class="min-w-0 rounded overflow-hidden bg-white dark:bg-c-d-blue">
  <div class="p-4 flex items-center">
    <div class="p-3 rounded-full text-green-500 dark:text-green-100 bg-green-100 dark:bg-green-500 mr-4">
      <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
      </svg>
    </div>
    <div>
      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
        Today Earnings
      </p>
      <p class="flex items-center text-md font-semibold text-gray-700 dark:text-gray-200">
        <img src="https://res.cloudinary.com/emil-dev/image/upload/v1668866108/1863974_vdvmor.png" class="w-5 h-5 mr-1">
        {{ Math.trunc(td) }}
      </p>
    </div>
  </div>
</div>

<div class="min-w-0 rounded overflow-hidden bg-white dark:bg-c-d-blue">
  <div class="p-4 flex items-center">
    <div class="p-3 rounded-full text-blue-500 dark:text-blue-100 bg-blue-100 dark:bg-blue-500 mr-4">
      <svg xmlns="http://www.w3.org/2000/svg" class=" w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
      </svg>
    </div>
    <div>
      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
        Today Offers
      </p>
      <p class="text-md font-semibold text-gray-700 dark:text-gray-200">
        {{ td_o }}
      </p>
    </div>
  </div>
</div>

<div class="min-w-0 rounded overflow-hidden bg-white dark:bg-c-d-blue">
  <div class="p-4 flex items-center">
    <div class="p-3 rounded-full text-blue-500 dark:text-blue-100 bg-blue-100 dark:bg-blue-500 mr-4">
      <svg xmlns="http://www.w3.org/2000/svg" class=" w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
      </svg>
    </div>
    <div>
      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
        Overall Points
      </p>
      <p class="flex items-center text-md font-semibold text-gray-700 dark:text-gray-200">
        <img src="https://res.cloudinary.com/emil-dev/image/upload/v1668866108/1863974_vdvmor.png" class="w-5 h-5 mr-1">
        {{ Math.trunc(ov_pts) }}
      </p>
    </div>
  </div>
</div>

<div class="min-w-0 rounded overflow-hidden bg-white dark:bg-c-d-blue">
  <div class="p-4 flex items-center">
    <div class="p-3 rounded-full text-blue-500 dark:text-blue-100 bg-blue-100 dark:bg-blue-500 mr-4">
      <svg xmlns="http://www.w3.org/2000/svg" class=" w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
      </svg>
    </div>
    <div>
      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
        Overall Offers
      </p>
      <p class="text-md font-semibold text-gray-700 dark:text-gray-200">
        {{ ov_offers }}
      </p>
    </div>
  </div>
</div>

</div>

<div class="col-span-2 border border-gray-300 dark:border-gray-700 rounded mt-3">
  <div class="rounded-t text-sm text-gray-700 dark:text-white bg-white dark:bg-c-d-blue border-b border-gray-300 dark:border-gray-700 px-2 py-1">
      Today Stats
  </div>
  <div class="block w-full overflow-x-aut bg-white dark:bg-c-d-blue rounded-b">  
    <apexchart height="350px" type="bar" :options="options" :series="series"></apexchart>
  </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-2 pt-3">
<div class="border border-gray-300 dark:border-gray-700 rounded">
  <div class="rounded-t text-md text-gray-700 dark:text-white bg-white dark:bg-c-d-blue border-b border-gray-300 dark:border-gray-700 px-2 py-1">
    Last {{ logs.length }} Offers
  </div>
  <div class="block w-full overflow-x-auto bg-white dark:bg-c-d-blue rounded-b">
    <table class="w-full text-left text-gray-700 dark:text-white">
      <thead class="text-gray-700 dark:text-white" style="font-size:14px;">
          <tr>
              <th scope="col" class="py-2 px-6">
                  Provider
              </th>
              <th scope="col" class="py-2 px-6">
                  Offer
              </th>
              <th scope="col" class="py-2 px-6">
                  Worth
              </th>
              <th scope="col" class="py-2 px-6">
                  Date
              </th>
          </tr>
      </thead>
      <tbody>
          <tr class="bg-white dark:bg-c-d-blue border-t border-gray-300 dark:border-gray-700" style="font-size:12px;" v-for="log in logs" :key="log">
              <th scope="row" class="py-2 px-6 font-medium whitespace-nowrap">
                 {{ log.wall }}
              </th>
              <td class="py-2 px-6 font-medium">
                 {{ log.cname }}
              </td>
              <td class="py-2 px-6 flex items-center font-medium ">
                 {{ Math.trunc(log.points) }}
                 <img src="https://res.cloudinary.com/emil-dev/image/upload/v1668866108/1863974_vdvmor.png" class="w-4 h-4 ml-1">
              </td>
              <td class="py-2 px-6 font-medium">
                 {{ format_date(log.created_at) }}
              </td>
          </tr>
      </tbody>
  </table>
  </div>
</div>

<div class="border border-gray-300 dark:border-gray-700 rounded">
  <div class="rounded-t text-md text-gray-700 dark:text-white bg-white dark:bg-c-d-blue border-b border-gray-300 dark:border-gray-700 px-2 py-1">
    Last {{ orders.length }} Orders  {{ date }}
  </div>
  <div class="block w-full overflow-x-auto bg-white dark:bg-c-d-blue rounded-b">
    <table class="w-full text-left text-gray-700 dark:text-white">
      <thead class="text-gray-700 dark:text-white" style="font-size:14px;">
          <tr>
              <th scope="col" class="py-2 px-6">
                  Item
              </th>
              <th scope="col" class="py-2 px-6">
                  Points
              </th>
              <th scope="col" class="py-2 px-6">
                  Status
              </th>
              <th scope="col" class="py-2 px-6">
                  Date
              </th>
          </tr>
      </thead>
      <tbody>
        <tr class="bg-white dark:bg-c-d-blue border-t border-gray-300 dark:border-gray-700" style="font-size:12px;" v-for="order in orders">
            <th scope="row" class="py-2 px-6 font-medium whitespace-nowrap">
             <div class="flex items-center">
              <img :src="'https://community.cloudflare.steamstatic.com/economy/image/' + order.icon" class="w-14 h-auto mr-3"/>
             </div>
            </th>
            <td class="py-2 px-6 font-medium">
              <span class="flex items-center">
                  {{ Math.trunc(order.points) }}
                  <img src="https://res.cloudinary.com/emil-dev/image/upload/v1668866108/1863974_vdvmor.png" class="w-4 h-4 ml-1">
              </span>
            </td>
            <td class="py-2 px-6 font-medium ">
              
              <span class="bg-yellow-600 w-auto text-white rounded px-2 py-1 pt-1">{{ order.status }}</span>

            </td>
            <td class="py-2 px-6 font-medium">
                {{ format_date(order.created_at) }}
            </td>
        </tr>
      </tbody>
  </table>
</div>
</div>
</div>

</template>

<script>
import moment from 'moment'
export default {
    name: "Dashboard",
    data() {
        return {
            logs: [],
            orders: [],
            data: [],
            dates: [],
            td: null,
            td_o: null,
            ov_pts: null,
            ov_offers: null,
            date:'',
            subDates: [],
            labels:[],
            values:[],
            series: [{
              name: 'Earnings',
              type: 'bar',
              data: []
              }, {
              name: 'Click',
              type: 'area',
              data: []
            }],
          options: {
            chart: {
              type: 'line',
              stacked: false,
              toolbar: {
              show: false,
            },
            },
            colors: ['#00E396', '#0090FF'],
            stroke: {
              width: [0, 2, 5],
              curve: 'smooth'
            },
            dataLabels: {
              enabled: false 
            },
            plotOptions: {
              bar: {
                columnWidth: '25%'
              }
            },
            fill: {
              opacity: [0.85, 0.25, 1],
              gradient: {
                inverseColors: false,
                shade: 'light',
                type: "vertical",
                opacityFrom: 0.85,
                opacityTo: 0.55,
                stops: [0, 100, 100, 100]
              }
            },
            markers: {
              size: 0
            },
            xaxis: {
              type: 'value',
              categories:[]
          },
            yaxis: {
              title: {
                text: 'Points',
              },
              min: 0
            },
            legend: {
              position: 'top',
              horizontalAlign: 'right'
      },           
      },
    }
    },
    created() {
        this.date = moment().format('YYYY-MM-DD')
        for (let i = 1; i <= 6; i++) {
      this.subDates.push(moment().subtract(i, 'days').format('YYYY-MM-DD'))  
    }
   // this.options.labels = [...this.subDates.reverse(),this.date];
    

        this.$axios.get('/sanctum/csrf-cookie').then(response => {
          this.$axios.get('/api/data/dashboard')
          .then(response => {
            this.data = response.data.usearn
            this.td = response.data.td
            this.td_o = response.data.td_offers
            this.ov_pts = response.data.ov_pts
            this.ov_offers = response.data.ov_offers
            this.logs = response.data.logs
            this.orders = response.data.orders  
            console.log(this.data);

            this.labels = this.data.map(earning => earning.date) //[...this.subDates.reverse(),this.date]
            this.options.xaxis.categories.push(...this.labels)

            this.values = this.data.map(earning => earning.total_earnings || 0)
            this.series[0].data.push(...this.values)
            this.series[1].data.push(...this.values)
          })
          .catch(function(error) {
              console.log(error);
          });
      });
  },
    methods: { 
      format_date(value){
         if (value) {
           return moment(String(value)).format('YYYY-MM-DD')
          }
      },
   },      
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/login";
        }
        next();
    }
}
</script>