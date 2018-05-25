//index.js
//获取应用实例
const app = getApp()

Page({
  data: {
    motto: 'Hello World',
  },

  //读取数据
  bindReadTap: function () {
    var page = this;
    wx.request({
      url: 'http://api.apitpl.dev/articles',
      header: {
        'Content-Type': 'application/json'
      },
      method: 'GET',
      data:{
        page: 1
      },
      success: function (res) {
        page.setData({ motto: res.data.content })
        console.log(res.data)
      }
    })
  },

  //新增数据
  bindCreateTap: function () {
    var page = this;
    wx.request({
      url: 'http://api.apitpl.dev/articles',
      header: {
        'Content-Type': 'application/json'
      },
      method: 'POST',
      data:{
        title:"testing article",
        content:"content is here",
        category_id:1,
        status:10
      },
      success: function (res) {
        //page.setData({ motto: res.data.content })
        console.log(res.data)
      }
    })
  },


  //修改数据
  bindUpdateTap: function () {
    var page = this;
    wx.request({
      url: 'http://api.apitpl.dev/articles/9',
      header: {
        'Content-Type': 'application/json'
      },
      method: 'PUT',
      data: {
        title: "modified title",
        content: "content is here",
        category_id: 1,
        status: 10
      },
      success: function (res) {
        //page.setData({ motto: res.data.content })
        console.log(res.data)
      }
    })
  },


  //删除数据
  bindDeleteTap: function () {
    var page = this;
    wx.request({
      url: 'http://api.apitpl.dev/articles/9',
      header: {
        'Content-Type': 'application/json'
      },
      method:'DELETE',
      data: {
      },
      success: function (res) {
        //page.setData({ motto: res.data.content })
        console.log(res.data)
      }
    })
  },

  //其他http动词
  bindOtherTap: function () {
    var page = this;
    wx.request({
      url: 'http://api.apitpl.dev/articles/1',
      header: {
        'Content-Type': 'application/json'
      },
      method: 'POST',
      data: {
      },
      success: function (res) {
        //page.setData({ motto: res.data.content })
        console.log(res.data)
      }
    })
  },

  //文章搜索
  bindSearchTap: function () {
    var page = this;
    wx.request({
      url: 'http://api.apitpl.dev/articles/search',
      header: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      method: 'POST',
      data: {
        keyword: '视频'
      },
      success: function (res) {
        //page.setData({ motto: res.data.content })
        console.log(res.data)
      }
    })
  },

  //Top 10
  bindTop10Tap: function () {
    var page = this;
    wx.request({
      url: 'http://api.apitpl.dev/top10',
      header: {
        'Content-Type': 'application/json'
      },
      method: 'GET',
      success: function (res) {
        //page.setData({ motto: res.data.content })
        console.log(res.data)
      }
    })
  },


  //登录
  bindLoginTap: function () {
    var page = this;
    wx.request({
      url: 'http://api.apitpl.dev/adminuser/login',
      header: {
        'Content-Type': 'application/json'
      },
      method: 'POST',
      data: {
        username: "weixi",
        password: "123456"
      },
      success: function (res) {
        //page.setData({ motto: res.data.content })
        console.log(res.data)
      }
    })
  },



  //有访问令牌时，读取数据
  bindAuthReadTap: function () {
    var page = this;
    wx.request({
      url: 'http://api.apitpl.dev/articles/1?access-token=YaQWk32dfTWQqQg6THG3BfysrPqo4-XD',
      header: {
        'Content-Type': 'application/json'
      },
      method: 'GET',
      data: {
        page: 1,
      },
      success: function (res) {
        page.setData({ motto: res.data.content })
        console.log(res.data)
      }
    })
  },



  //BasicAuth读取数据
  bindBasicAuthReadTap: function () {
    var page = this;
    wx.request({
      url: 'http://api.apitpl.dev/articles/2',
      header: {
        'Content-Type': 'application/json'
      },
      method: 'GET',
      data: {
        page: 1,
      },
      success: function (res) {
        page.setData({ motto: res.data.content })
        console.log(res.data)
      }
    })
  },







  //事件处理函数
  bindViewTap: function() {
    wx.navigateTo({
      url: '../logs/logs'
    })
  },
  onLoad: function () {
    if (app.globalData.userInfo) {
      this.setData({
        userInfo: app.globalData.userInfo,
        hasUserInfo: true
      })
    } else if (this.data.canIUse){
      // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
      // 所以此处加入 callback 以防止这种情况
      app.userInfoReadyCallback = res => {
        this.setData({
          userInfo: res.userInfo,
          hasUserInfo: true
        })
      }
    } else {
      // 在没有 open-type=getUserInfo 版本的兼容处理
      wx.getUserInfo({
        success: res => {
          app.globalData.userInfo = res.userInfo
          this.setData({
            userInfo: res.userInfo,
            hasUserInfo: true
          })
        }
      })
    }
  },
  getUserInfo: function(e) {
    console.log(e)
    app.globalData.userInfo = e.detail.userInfo
    this.setData({
      userInfo: e.detail.userInfo,
      hasUserInfo: true
    })
  }
})
