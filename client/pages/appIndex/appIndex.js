Page({
  data: {
    isFinished: true,
    showHotestRoutesList: [
      {
        title:  "标题1",
        status: "已完成",
        likeNum: 100,
        followers: 100,
        includings: 100,
        createTime: 100,
        passTime: 100
      },
      {
        title: "标题2",
        status: "已完成",
        likeNum: 100,
        followers: 100,
        includings: 100,
        createTime: 100,
        passTime: 100
      },
      {
        title: "标题3",
        status: "已完成",
        likeNum: 100,
        followers: 100,
        includings: 100,
        createTime: 100,
        passTime: 100
      }
    ]
  },
  buttonFinished(){
    this.setData({
      isFinished:true
    })
  },
  buttonUnFinished() {
    this.setData({
      isFinished: false
    })
  }
})