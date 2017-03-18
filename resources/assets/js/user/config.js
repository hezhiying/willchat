const debug = process.env.NODE_ENV !== 'production';

const Config = {
  apiRoot: '/api/user',
  timeout: debug ? 10000 : 15000,
  jwtTokenName: 'willchat_jwt_token'
};

export default Config;
