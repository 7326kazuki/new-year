<script setup>
import {ref} from "@vue/reactivity";
import {router, useForm} from '@inertiajs/vue3'

defineProps({
    selectItems: {
        trainingMenu: {
            value: String,
            text: String
        },
        unitType: {
            value: String,
            text: String
        },
        counterplanType: {
            value: String,
            text: String
        },
    },
    trainings: Object,
    books: Object,
    alcohols: Object,
    totalPrice: Number
});

const formRequest = useForm({
    training: {
        menu: undefined,
        times: undefined,
        unit: undefined
    },
    book: {
        name: undefined,
    },
    money: {
        type: "食費",
        price: undefined
    },
    alcohol: {
        counterplan: undefined
    },
    requestType: undefined
})
let isOpenModal = ref(false);
let isOpenTrainingModal = ref(false);
let isOpenBookModal = ref(false);
let isOpenEatMoneyModal = ref(false);
let isOpenAlcoholModal = ref(false);
let isOpenHistoryModal = ref(false);

function closeModal() {
    isOpenModal.value = false;
    isOpenTrainingModal.value = false;
    isOpenBookModal.value = false;
    isOpenEatMoneyModal.value = false;
    isOpenAlcoholModal.value = false;
    isOpenHistoryModal.value = false;
    formRequest.reset();
}

function openModal(name) {
    isOpenModal.value = true;
    if (name === "training") {
        isOpenTrainingModal.value = true;
    }
    if (name === "book") {
        isOpenBookModal.value = true;
    }
    if (name === "money") {
        isOpenEatMoneyModal.value = true;
    }
    if (name === "alcohol") {
        isOpenAlcoholModal.value = true;
    }
    if (name === "history") {
        isOpenHistoryModal.value = true;
    }
}

function post() {
    if (isOpenTrainingModal.value) {
        formRequest.requestType = "training";
    }
    if (isOpenBookModal.value) {
        formRequest.requestType = "book";
    }
    if (isOpenEatMoneyModal.value) {
        formRequest.requestType = "money";
    }
    if (isOpenAlcoholModal.value) {
        formRequest.requestType = "alcohol";
    }
    router.post('/', formRequest, {
        onSuccess() {
            window.location.reload();
        }
    });
}
</script>

<template>
    <div class="main">
        <div id="training" class="area" @click="openModal('training')"
             :style="trainings.length > 0 ? '' : 'background: darkred !important'">
            筋トレ
        </div>
        <div id="book" class="area" @click="openModal('book')"
             :style="books.length > 0 ? '' : 'background: darkred !important'">
            読書
        </div>
        <div id="money" class="area" @click="openModal('money')">
            食費
        </div>
        <div id="alcohol" class="area" @click="openModal('alcohol')">
            お酒我慢
        </div>
        <div id="history" class="area" @click="openModal('history')">
            履歴
        </div>
    </div>
    <div v-show="isOpenModal" class="modal">
        <div class="modal-inner">
            <div class="form-area">
                <div v-show="isOpenTrainingModal">
                    種目:
                    <select v-model="formRequest.training.menu">
                        <option :value="undefined"></option>
                        <option v-for="item in selectItems.trainingMenu" :value="item.value">{{ item.text }}</option>
                    </select>
                    <br>
                    回数: <input v-model="formRequest.training.times" type="number"><br>
                    単位:
                    <select v-model="formRequest.training.unit">
                        <option :value="undefined"></option>
                        <option v-for="item in selectItems.unitType" :value="item.value">{{ item.text }}</option>
                    </select>
                </div>
                <div v-show="isOpenBookModal">
                    書籍名: <input v-model="formRequest.book.name">
                </div>
                <div v-show="isOpenEatMoneyModal">
                    金額: <input v-model="formRequest.money.price" type="number">
                </div>
                <div v-show="isOpenAlcoholModal">
                    対策:
                    <select v-model="formRequest.alcohol.counterplan">
                        <option :value="undefined"></option>
                        <option v-for="item in selectItems.counterplanType" :value="item.value">{{ item.text }}</option>
                    </select>
                </div>
                <div v-show="isOpenHistoryModal">
                    <div class="history-area">
                        筋トレ
                        <table>
                            <thead>
                            <tr>
                                <td>
                                    メニュー
                                </td>
                                <td>
                                    合計
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="training in trainings">
                                <td>
                                    {{ training.menu }}
                                </td>
                                <td>
                                    {{ training.times }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="history-area">
                        読書
                        <table>
                            <thead>
                            <tr>
                                <td>
                                    書籍名
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="book in books">
                                <td>
                                    {{ book.name }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="history-area">
                        お酒我慢
                        <table>
                            <thead>
                            <tr>
                                <td>
                                    対策
                                </td>
                                <td>
                                    合計
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="alcohol in alcohols">
                                <td>
                                    {{ alcohol.counterplan }}
                                </td>
                                <td>
                                    {{ alcohol.times }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="history-area">
                        食費: {{ totalPrice }}
                    </div>
                </div>
                <div class="button-area">
                    <button v-show="!isOpenHistoryModal" @click="post()">送信</button>
                    <button @click="closeModal()">閉じる</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.history-area {
    text-align: left;
}
.history-area:nth-child(n+2) {
    margin-top: 5%;
}
table {
    border: black solid 1px;
    width: 100%;
    border-collapse: collapse;
}
table tr td {
    text-align: center;
    border: black solid 1px;
}
.button-area {
    margin-top: 10%;
    text-align: center;
}

button {
    width: 25%;
    padding: 2% 0;
}

input, select {
    padding: 1.5%;
    margin-bottom: 2%;
}

button:last-child {
    margin-left: 5%;
}

.form-area {
    position: relative;
    top: 50%;
    left: 50%;
    transform: translateY(-50%) translateX(-50%);
}

.modal {
    transition: opacity;
    position: absolute;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
}

.modal-inner {
    padding: 5%;
    position: absolute;
    width: 75%;
    height: 75%;
    top: 50%;
    left: 50%;
    transform: translateY(-50%) translateX(-50%);
    background: white;
    border-radius: 20px;
    text-align: center;
}

.main {
    max-width: 440px;
    max-height: 956px;
    width: 100%;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    justify-content: center;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateY(-50%) translateX(-50%);
}

.area {
    color: white;
    text-shadow: black 1px 1px;
    font-weight: bold;
    font-size: 18px;
    letter-spacing: 4px;
    background: darkseagreen;
    width: 40%;
    text-align: center;
    padding: 8% 0;
    margin-bottom: 5%;
    border-radius: 20px;
}

.area:nth-child(2n) {
    margin-left: 5%;
}
</style>
