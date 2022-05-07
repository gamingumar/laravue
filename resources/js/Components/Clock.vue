<script setup>
  import {ref, onMounted, reactive, onUnmounted} from 'vue'

  const timer = ref(null)
  onMounted(() => timer.value = setInterval(() => updateTime(), 1000));
  onUnmounted(() => clearInterval(timer.value))

  const state = reactive({ date: new Date(), timeStr: "00 : 00 : 00"});


  function updateTime() {
    let d = state.date;
    d.setSeconds(d.getSeconds() + 1)

    state.date = d;

    let hours = d.getHours();
    let minutes = d.getMinutes();
    let seconds = d.getSeconds();

    let h = hours <= 9 ? `${hours}`.padStart(2, 0) : hours;
    let m = minutes <= 9 ? `${minutes}`.padStart(2, 0) : minutes;
    let s = seconds <= 9 ? `${seconds}`.padStart(2, 0) : seconds;

    state.timeStr = `${h} : ${m} : ${s}`
  }
  
</script>

<template>
  <h1 class="font-semibold text-7xl text-gray-800 leading-tight">{{state.timeStr}}</h1>
</template>



<style>

</style>