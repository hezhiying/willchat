const getters = {
  accounts: (state) => {
    let temp = window.localStorage.getItem('willchat_accounts');

    return JSON.parse(temp);
  }
};

export default getters;
