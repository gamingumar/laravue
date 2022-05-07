<script setup>
import { ref, onMounted, reactive, onUnmounted } from "vue";
import Button from "@/Components/Button.vue";

const timer = ref(null);
onMounted(() => (timer.value = setInterval(() => updateTime(), 1000)));
onUnmounted(() => clearInterval(timer.value));

const state = reactive({ date: new Date(), timeStr: "00 : 00 : 00" });

function updateTime(secondsToAdd = 1) {
    let d = state.date;
    d.setSeconds(d.getSeconds() + secondsToAdd);

    state.date = d;

    let hours = d.getHours();
    let minutes = d.getMinutes();
    let seconds = d.getSeconds();

    let h = hours <= 9 ? `${hours}`.padStart(2, 0) : hours;
    let m = minutes <= 9 ? `${minutes}`.padStart(2, 0) : minutes;
    let s = seconds <= 9 ? `${seconds}`.padStart(2, 0) : seconds;

    state.timeStr = `${h} : ${m} : ${s}`;
}

function addHour() {
    updateTime(3600);
}
function minusHour() {
    updateTime(-3600);
}

function addMinute() {
    updateTime(60);
}
function minusMinute() {
    updateTime(-60);
}

function addSecond() {
    updateTime(1);
}
function minusSecond() {
    updateTime(-1);
}
</script>

<template>
    <div class="flex items-center justify-center mt-4">
        <Button @click="minusHour" class="ml-4"> - Hour </Button>
        <Button @click="minusMinute" class="ml-4"> - Minute </Button>
        <Button @click="minusSecond" class="ml-4"> - Second </Button>
    </div>
    <div class="flex items-center justify-center mt-4">
        <h1 class="font-semibold text-7xl text-gray-800 leading-tight">
            {{ state.timeStr }}
        </h1>
    </div>
    <div class="flex items-center justify-center mt-4">
        <Button @click="addHour" class="ml-4"> + Hour </Button>
        <Button @click="addMinute" class="ml-4"> + Minute </Button>
        <Button @click="addSecond" class="ml-4"> + Second </Button>
    </div>
</template>

<style></style>
