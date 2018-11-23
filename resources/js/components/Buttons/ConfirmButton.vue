<!-- data-toggle="tooltip" -->
<template>
  <el-tooltip class="item" effect="dark" :content="currentTooltipMessage" placement="top">
    <el-button @blur.native="reset()" @click.prevent="incrementStep()" size="small" :type="currentType" :icon="currentMessage" circle></el-button>
  </el-tooltip>
<!-- <button
class="btn btn-xs pull-right"
:class="[ css, currentStep == lastMessageIndex - 1? 'btn-success' : 'btn-danger' ]"
v-on:click='incrementStep()'>
<i :class="currentMessage"></i>
</button>-->
</template>

<script>
export default {
name: 'confirm-button',
props: {
  messages: Array,
  css: {
    type: String,
    default: ''
  },
},
data() {
  return {
    defaultSteps: [
      'el-icon-delete',
      'el-icon-check'
    ],
    currentStep: 0,
    tooltipMessages: [
      'Eliminar',
      'Confirmar'
    ],
    type: [
      'danger',
      'success'
    ],
  }
},
computed: {
  messageList() {
    return this.messages ? this.messages : this.defaultSteps
  },
  currentMessage() {
    return this.messageList[this.currentStep]
  },
  currentTooltipMessage() {
    return this.tooltipMessages[this.currentStep]
  },
  currentType() {
    return this.type[this.currentStep]
  },
  lastMessageIndex() {
    return this.messageList.length
  },
  stepsComplete() {
    return this.currentStep === this.lastMessageIndex
  }
},
methods: {
  incrementStep() {
    this.currentStep++
    if (this.stepsComplete) {
      this.$emit('confirmation-success');
      this.reset();
    }
    else {
      this.$emit('confirmation-incremented')
    }
  },
  reset() {
    this.currentStep = 0
    this.$emit('confirmation-reset')
  },
},
}
</script>
