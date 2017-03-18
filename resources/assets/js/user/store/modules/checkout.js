const state = {
  order: {
    name: '',
    mobile: '',
    province: '',
    city: '',
    area: '',
    address: '',
    friend_name: '',
    friend_mobile: '',
    friend_province: '',
    friend_city: '',
    friend_area: '',
    friend_address: '',
    wishes: '',
    amount: 1,
    remark: ''
  },
  step: 1,
  totalStep: 3
};

const getters = {
  isFirstStep (state) {
    return state.step === 1;
  },

  isLastStep (state) {
    return state.step === state.totalStep;
  },

  nextBtnText (state) {
    return state.step === state.totalStep ? '去结算' : '下一步';
  },

  pca (state) {
    let pca = state.order.province + state.order.city + state.order.area;
    return pca ? pca : '请选择';
  },

  friend_pca (state) {
    let pca = state.order.friend_province + state.order.friend_city + state.order.friend_area;
    return pca ? pca : '请选择';
  },

  // 下一步按钮禁用状态  
  canGoNext (state) {
    if (state.step === 1) {
      if (state.order.name && state.order.mobile && state.order.province && state.order.city && state.order.area && state.order.address) {
        return true;
      } else {
        return false;
      }
    } else if (state.step === 2) {
      if (state.order.friend_name && state.order.friend_mobile && state.order.friend_province && state.order.friend_city && state.order.friend_area && state.order.friend_address) {
        return true;
      } else {
        return false;
      }
    } else if (state.step === 3) {
      if (state.order.amount) {
        return true;
      } else {
        return false;
      }
    }
  } 
};

const actions = {
};

const mutations = {
  UPDATE_ORDER (state, value) {
    state.order[value.key] = value.value;
  },

  UPDATE_STEP (state, value) {
    state.step = value;
  },

  UPDATE_CAN_GO_NEXT (state, value) {
    state.canGoNext = value;
  }
};

export default {
  state,
  getters,
  actions,
  mutations
};
