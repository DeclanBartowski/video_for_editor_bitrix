BX.addCustomEvent('OnEditorInitedBefore', function (editor) {
  var EDITOR = this;
  function VideoDialog(tag) {
    this.editor = EDITOR;
    let id = 0;
    if (typeof tag != 'undefined') {
      var params = tag.params;
      id = params.parameter.id;
    }
    this.Dialog = new BX.CDialog({
      'title': 'Выбрать видео',
      'content_url': '/local/modules/sp.editor/ajax/list_video.php?id=' + id,
      'height': 70,
      'buttons': [{
        title: 'Cохранить',
        id: 'savebtn',
        name: 'savebtn',
        className: 'adm-btn-save',
        action: function () {
          let html = '<custom-video-player video-id="' + $('#video_player').val() + '">' + $('#video_player option:selected').text() + '</custom-video-player>';
          if (typeof tag != 'undefined') {
            tag.params.html = html;
          } else {
            editor.selection.InsertHTML(html);
          }
          EDITOR.synchro.FullSyncFromIframe();
          this.parentWindow.Close();
        }
      }, BX.CDialog.btnClose]
    });
  }

  VideoDialog.prototype = {
    Show: function () {
      this.Dialog.Show();
    },
  }

  this.AddButton({
    name: 'Редактор видео',
    id: 'sp-video-edit',
    src: '/bitrix/images/fileman/htmleditor/bxhtmled-button-video.svg?v=4',
    iconClassName: 'bxhtmled-button-video',
    toolbarSort: 20,
    handler: function () {
      var Dialog = new VideoDialog();
      Dialog.Show();
    }
  });

  this.AddCustomParser(function (content) {
    var
      _this = EDITOR.phpParser,
      index = 0;

    _this.arVideoPlayers = {};

    var $content = $("<div></div>");
    $content.append(content);

    $content.find("custom-video-player").each(function () {
      var div = $("<div></div>");
      div.append($(this).clone());
      _this.arVideoPlayers[index] = {
        html: div.clone().html(),
        parameter: {
          id: $(this).attr('video-id')
        }
      };
      $(this).replaceWith("#BXVIDEOPLAYER_" + (index++) + "#");
    });
    content = $content.html();
    content = content.replace(/#BX(VIDEOPLAYER)_(\d+)#/g, function (str, type, ind) {
      var res = EDITOR.phpParser.GetSurrogateHTML("videoplayer", "Видиеоплеер", "Видиеоплеер", _this.arVideoPlayers[ind]);
      return res || str;
    });
    return content;
  });

  BX.addCustomEvent("OnGetBxNodeList", function (e, t) {
    var _this = this.phpParser;
    _this.arBxNodes.videoplayer = {
      Parse: function (params) {
        return _this._GetUnParsedContent(params.html);
      }
    };
  });

  BX.addCustomEvent("OnSurrogateDblClick", function (e, t) {
    if (t.tag != 'videoplayer') return;
    if (typeof EDITOR.bxTags[t.id] != 'undefined') {
      var Dialog = new VideoDialog(t);
      Dialog.Show();
    }
  })
});
