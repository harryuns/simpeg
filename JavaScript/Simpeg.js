var InitForm = {
	InitUser: function() {
		// tenaga pendidikan
		if (Web.UserGroupID == 1061) {
			var page_link = window.location.href;
			var array_match = page_link.match(new RegExp('pegawai_modul\/skp', 'gi'));
			if (typeof(array_match) == 'undefined' || array_match == null) {
				$('#InitTable .Delete').parent('td').html('&nbsp;');
				$('#ListPegawai .DeletePegawai').parent('td').html('&nbsp;');
				$('#CntImage .Relative .position .cursor').remove();
				$('input[type="file"]').remove();
				$('input[name="UploadFile"]').remove();
				
				for (var i = 0; i < $('input[type="submit"]').length; i++) {
					var Input = $('input[type="submit"]').eq(i);
					if (InitForm.InArray(Input.val(), ['Save', 'Tambah'])) {
						Input.remove();
					}
				}
			} else if (array_match.length == 1 && array_match[0] == 'pegawai_modul/skp') {
				// free to write
			}
		}
		
		// non admin
		else if (! Func.InArray(Web.UserGroupID, Web.admin_group_id)) {
//			$('#InitTable .Edit').parent('td').html('&nbsp;');
			$('#InitTable .Delete').parent('td').html('&nbsp;');
			$('#ListPegawai .DeletePegawai').parent('td').html('&nbsp;');
			$('#CntImage .Relative .position .cursor').remove();
			$('input[type="file"]').remove();
			$('input[name="UploadFile"]').remove();
			
			for (var i = 0; i < $('input[type="submit"]').length; i++) {
				var Input = $('input[type="submit"]').eq(i);
				if (InitForm.InArray(Input.val(), ['Save', 'Tambah'])) {
					Input.remove();
				}
			}
		}
	},
    Start: function(Container) {
        var Input = $('#' + Container + ' input');
        for (var i = 0; i < Input.length; i++) {
            if (Input.eq(i).hasClass('datepicker')) {
                Input.eq(i).datepicker({ dateFormat: 'dd-mm-yy', changeYear: true, changeMonth: true, yearRange: 'c-50:c+65' });
                Input.eq(i).attr('maxlength', '10');
                Input.eq(i).parent('td').append(' <img src="' + Web.HOST + '/images/Info.png" title="Format penulisan tanggal adalah : DD-MM-YYYY" class="Info">');
            }
            else if (Input.eq(i).hasClass('disabled')) {
                Input.eq(i).change(function() {
                    $(this).val('');
                });
            }
            else if (Input.eq(i).hasClass('integer')) {
                Input.eq(i).keyup(function() {
                    var Value = $(this).val();
                    Value = Value.replace(new RegExp('[^0-9\.]', 'gi'), '');
                    $(this).val(Value);
                });
            }
            else if (Input.eq(i).hasClass('NonInteger')) {
                Input.eq(i).keyup(function() {
                    var Value = $(this).val();
                    Value = Value.replace(new RegExp('[0-9]', 'gi'), '');
                    $(this).val(Value);
                });
            }
            else if (Input.eq(i).hasClass('float')) {
                Input.eq(i).keyup(function() {
                    var Value = $(this).val();
                    Value = Value.replace(new RegExp('[^0-9\.\,]', 'gi'), '');
                    $(this).val(Value);
                });
            }
            else if (Input.eq(i).hasClass('alphanumeric')) {
                Input.eq(i).keyup(function() {
                    var Value = $(this).val();
                    Value = Value.replace(new RegExp('[^0-9a-z]', 'gi'), '');
                    $(this).val(Value);
                });
            }
            else if (Input.eq(i).hasClass('sk_char')) {
                Input.eq(i).keyup(function() {
                    var Value = $(this).val();
                    Value = Value.replace(new RegExp('[^0-9a-z\ \.\/\-]', 'gi'), '');
                    $(this).val(Value);
                });
            }
            else if (Input.eq(i).hasClass('sk_char_wo_space')) {
                Input.eq(i).keyup(function() {
                    var Value = $(this).val();
                    Value = Value.replace(new RegExp('[^0-9a-z\.\/\-]', 'gi'), '');
                    $(this).val(Value);
                });
            }
            else if (Input.eq(i).hasClass('link')) {
                Input.eq(i).click(function() {
                    var LinkRedirect = $(this).attr('alt');
                    
                    if (LinkRedirect != '') {
                        window.location = LinkRedirect;
                    }
                });
            }
        }
    },
    Convert: function(Container) {
        var Input = $('#' + Container + ' input');
        for (var i = 0; i < Input.length; i++) {
            if (Input.eq(i).hasClass('datepicker')) {
                var Value = $.trim(Input.eq(i).val());
                var Result = Value;
                
                if (Value != '') {
                    var ArrayValue = Value.split('-');
                    if (ArrayValue[2].length == 4)
                        Result = ArrayValue[2] + '-' + ArrayValue[1] + '-' + ArrayValue[0];
                }
                
                Input.eq(i).val(Result);
            }
        }
    },
    Validation: function(Container) {
        var ArrayError = [];
        var Input = $('#' + Container + ' input');
        
        for (var i = 0; i < Input.length; i++) {
            Input.eq(i).removeClass('ui-state-highlight');
            
            if (Input.eq(i).hasClass('required')) {
                var Value = $.trim(Input.eq(i).val());
                
                if (Value == '') {
                    ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
					Input.eq(i).addClass('ui-state-highlight');
                }
            }
            if (Input.eq(i).hasClass('integer') || Input.eq(i).hasClass('datepicker')) {
                var Value = $.trim(Input.eq(i).val());
                var ValueResult = Value.replace(new RegExp('[^0-9\-]', 'gi'), '');
                
                if (Value != ValueResult) {
                    ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
                }
            }
            if (Input.eq(i).hasClass('year') && (Input.eq(i).val().length != 0 && Input.eq(i).val().length != 4)) {
                Input.eq(i).addClass('ui-state-highlight');
                ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
            }
        }
        
        return ArrayError;
    },
    GetValue: function(Container) {
        var Data = Object();
        
        var Input = $('#' + Container + ' input, #' + Container + ' select');
        for (var i = 0; i < Input.length; i++) {
            Data[Input.eq(i).attr('name')] = Input.eq(i).val();
        }
        
        return Data;
    },
    Form: {
        GetValue: function(Container) {
            var Data = Object();
            
            var Input = $('#' + Container + ' input, #' + Container + ' select, #' + Container + ' textarea');
            for (var i = 0; i < Input.length; i++) {
                Data[Input.eq(i).attr('name')] = Input.eq(i).val();
            }
            
            return Data;
        }
    },
    GetTimeFromString: function(String) {
        String = $.trim(String);
        if (String == '') {
            return new Date();
        }
        
        var Data = new Date();
        var ArrayData = String.split('-');
        if (ArrayData[2] != null && ArrayData[2].length == 4) {
            Data = new Date(ArrayData[2] + '-' + ArrayData[1] + '-' + ArrayData[0]);
        }
        
        return Data;
    },
	InArray: function(Value, Array) {
		var Result = false;
		for (var i = 0; i < Array.length; i++) {
			if (Value == Array[i]) {
				Result = true;
				break
			}
		}
		return Result;
	}
}

var Func = {
	ajax: function(p) {
		p.is_json = (p.is_json == null) ? 1 : p.is_json;
		
		$.ajax({ type: 'POST', url: p.url, data: p.param, success: function(data) {
			if (p.is_json == 1) {
				eval('var result = ' + data);
				p.callback(result);
			} else {
				p.callback(data);
			}
		} });
	},
	set_combo: function(p) {
		/*	how to use
			var param = {
				value: 30,
				combo: $('[name="K_JENJANG"]'),
				callback: function() {
				}
				ajax: {
					url: Web.HOST + '/index.php/Ajax/Jenjang',
					param: { Action: 'GetJenjangByUnitKerja', K_UNIT_KERJA: $('[name="K_UNIT_KERJA"]').val() }
				}
			}
			Func.set_combo(param);
		/*	*/
		
		var ajax_param = p.ajax;
		ajax_param.is_json = false;
		ajax_param.callback = function(option) {
			p.combo.html(option);
			
			// set value
			if (typeof(p.value) != 'undefined') {
				p.combo.val(p.value);
			}
			
			// set callback
			if (typeof(p.callback) != 'undefined') {
				p.callback();
			}
		}
		
		Func.ajax(ajax_param);
	},
	swap_date: function(Value) {
		if (Value == null) {
			return '';
		}

		var ArrayValue = Value.split('-');
		if (ArrayValue.length != 3) {
			return '';
		}

		return ArrayValue[2] + '-' + ArrayValue[1] + '-' + ArrayValue[0];
	},
	rec_delete: function(p) {
		ShowDialogObject({
			ArrayMessage: ['Apa anda yakin menghapus data ini ?'],
			ArrayButton: {
				Ya: function() {
					Func.ajax({ url: p.action, param: p.param, callback: function(result) {
						if (result.status) {
							window.location = window.location.href;
						} else {
							ShowDialogObject({ ArrayMessage: [result.message] });
						}
					} });
				},
				Tidak: function() {
					$(this).dialog("close");
				}
			}
		});
	},
	
	ArrayToJson: function(Data) {
		var Temp = '';
		for (var i = 0; i < Data.length; i++) {
			Temp = (Temp.length == 0) ? Func.ObjectToJson(Data[i]) : Temp + ',' + Func.ObjectToJson(Data[i]);
		}
		return '[' + Temp + ']';
	},
	InArray: function(Value, Array) {
		var Result = false;
		for (var i = 0; i < Array.length; i++) {
			if (Value == Array[i]) {
				Result = true;
				break
			}
		}
		return Result;
	},
	IsEmpty: function(value) {
		var Result = false;
		if (value == null || value == 0) {
			Result = true;
		} else if (typeof(value) == 'string') {
			value = Helper.Trim(value);
			if (value.length == 0) {
				Result = true;
			}
		}
		
		return Result;
	},
	ObjectToJson: function(obj) {
		var str = '';
		for (var p in obj) {
			if (obj.hasOwnProperty(p)) {
				if (obj[p] != null) {
					str += (str.length == 0) ? str : ',';
					str += '"' + p + '":"' + obj[p] + '"';
				}
			}
		}
		str = '{' + str + '}';
		return str;
	},
	SyncComboParam: function(c, Param) {
		var ArrayConfig = ['renderTo', 'name', 'fieldLabel', 'anchor', 'id', 'allowBlank', 'blankText', 'tooltip', 'iconCls', 'width', 'listeners', 'value'];
		for (var i = 0; i < ArrayConfig.length; i++) {
			if (Param[ArrayConfig[i]] != null) {
				c[ArrayConfig[i]] = Param[ArrayConfig[i]];
			}
		}
		return c;
	},
	Trim: function(value) {
		return value.replace(/^\s+|\s+$/g,'');
	}
}

var Site = {
    Form: {
		InlineWarning: function(Input) {
			Input.parent('td').append('<div class="CntWarning">' + Input.attr('alt') + '</div>');
		},
        Start: function(Container) {
            var Input = jQuery('#' + Container + ' input');
            for (var i = 0; i < Input.length; i++) {
                if (Input.eq(i).hasClass('datepicker')) {
                    Input.eq(i).datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: 'c-20:c+10' });
                }
                else if (Input.eq(i).hasClass('integer') || Input.eq(i).hasClass('postalcode')) {
                    Input.eq(i).keyup(function(Param) {
						var Value = jQuery(this).val();
                        Value = Value.replace(new RegExp('[^0-9\.]', 'gi'), '');

						if (Param.keyCode == 16 || Param.keyCode == 17 || Param.keyCode == 18 || Param.ctrlKey || Param.shiftKey) {
							return true;
						}

						jQuery(this).val(Value);
                    });
                }
				else if (Input.eq(i).hasClass('alphabet')) {
					Input.eq(i).keyup(function(Param) {
						var Value = jQuery(this).val();
						Value = Value.replace(new RegExp('[^a-z\ ]', 'gi'), '');

						if (Param.keyCode == 16 || Param.keyCode == 17 || Param.keyCode == 18 || Param.ctrlKey || Param.shiftKey) {
							return true;
						}

						jQuery(this).val(Value);
					});
				}
				else if (Input.eq(i).hasClass('float')) {
					Input.eq(i).keyup(function(Param) {
						var Value = jQuery(this).val();
						Value = Value.replace(new RegExp('[^0-9\.]', 'gi'), '');

						if (Param.keyCode == 16 || Param.keyCode == 17 || Param.keyCode == 18 || Param.ctrlKey || Param.shiftKey) {
							return true;
						}

						jQuery(this).val(Value);
					});
				}
            }
        },
        Validation: function(Container, Param) {
			Param.Inline = (Param.Inline == null) ? false : Param.Inline;

            var ArrayError = [];
			jQuery('.CntWarning').remove();
            
            var Input = jQuery('#' + Container + ' input');
            for (var i = 0; i < Input.length; i++) {
                Input.eq(i).removeClass('ui-state-highlight');
                
                if (Input.eq(i).hasClass('required')) {
                    var Value = jQuery.trim(Input.eq(i).val());
                    
                    if (Value == '') {
                        Input.eq(i).addClass('ui-state-highlight');
                        ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
						if (Param.Inline) Site.Form.InlineWarning(Input.eq(i));
                    }
                }
                if (Input.eq(i).hasClass('integer') || Input.eq(i).hasClass('datepicker')) {
                    var Value = jQuery.trim(Input.eq(i).val());
                    var ValueResult = Value.replace(new RegExp('[^0-9\-]', 'gi'), '');
                    
                    if (Value != ValueResult) {
                        Input.eq(i).addClass('ui-state-highlight');
                        ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
						if (Param.Inline) Site.Form.InlineWarning(Input.eq(i));
                    }
                }
                if (Input.eq(i).hasClass('datepicker')) {
                    var Result = true;
                    var Value = jQuery.trim(Input.eq(i).val());
                    var ArrayValue = Value.split('-');
                    
                    if (Value.length == 0) {
                        Result = true;
                    } else if (ArrayValue.length != 3) {
                        Result = false;
                    } else if (ArrayValue[0] == '' || ArrayValue[1] == '' || ArrayValue[2] == '') {
                        Result = false;
                    }
                    
                    if (!Result) {
                        Input.eq(i).addClass('ui-state-highlight');
						if (Param.Inline) Site.Form.InlineWarning(Input.eq(i));
                        ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
                    }
                }
                if (Input.eq(i).hasClass('email') && ! Site.IsValidEmail(Input.eq(i).val())) {
					if (Input.eq(i).val() != '') {
						Input.eq(i).addClass('ui-state-highlight');
						ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
						if (Param.Inline) Site.Form.InlineWarning(Input.eq(i));
					}
                }
                if (Input.eq(i).hasClass('postalcode') && (Input.eq(i).val().length != 0 && Input.eq(i).val().length != 5)) {
                    Input.eq(i).addClass('ui-state-highlight');
                    ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
					if (Param.Inline) Site.Form.InlineWarning(Input.eq(i));
                }
                if (Input.eq(i).hasClass('year') && (Input.eq(i).val().length != 0 && Input.eq(i).val().length != 4)) {
                    Input.eq(i).addClass('ui-state-highlight');
                    ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
					if (Param.Inline) Site.Form.InlineWarning(Input.eq(i));
                }
            }
            
            var Select = jQuery('#' + Container +' select');
            for (var i = 0; i < Select.length; i++) {
                if (Select.eq(i).hasClass('required') && (Select.eq(i).val() == '' || Select.eq(i).val() == '-')) {
                    Select.eq(i).addClass('ui-state-highlight');
                    ArrayError[ArrayError.length] = Select.eq(i).attr('alt');
					if (Param.Inline) Site.Form.InlineWarning(Select.eq(i));
                } else {
                    Select.eq(i).removeClass('ui-state-highlight');
                }
            }
            
            var TextArea = jQuery('#' + Container +' textarea');
            for (var i = 0; i < TextArea.length; i++) {
                var Value = TextArea.eq(i).val();
                Value = jQuery.trim(Value);
                
                if (TextArea.eq(i).hasClass('required') && TextArea.eq(i).val() == '') {
                    TextArea.eq(i).addClass('ui-state-highlight');
                    ArrayError[ArrayError.length] = TextArea.eq(i).attr('alt');
                } else {
                    TextArea.eq(i).removeClass('ui-state-highlight');
                }
            }
            
            return ArrayError;
        },
        GetValue: function(Container) {
			var PrefixCheck = Container.substr(0, 1);
			if (! Func.InArray(PrefixCheck, ['.', '#'])) {
				Container = '#' + Container;
			}

            var Data = Object();
			var set_value = function(obj, name, value) {
				if (typeof(name) == 'undefined') {
					return obj;
				} else if (name.length < 3) {
					obj[name] = value;
					return obj;
				}

				var endfix = name.substr(name.length - 2, 2);
				if (endfix == '[]') {
					var name_valid = name.replace(endfix, '');
					if (obj[name_valid] == null) {
						obj[name_valid] = [];
					}
					obj[name_valid].push(value);
				} else {
					obj[name] = value;
				}

				return obj;
			}
            
            var Input = jQuery(Container + ' input, ' + Container + ' select, ' + Container + ' textarea');
            for (var i = 0; i < Input.length; i++) {
				var name = Input.eq(i).attr('name');
				var value = Input.eq(i).val();
				
				if (name.length == 0 || Input.eq(i).hasClass('ignore')) {
					continue;
				} else if (Input.eq(i).attr('type') == 'checkbox') {
					var Checked = Input.eq(i).attr('checked');
					if (Checked) {
						Data = set_value(Data, name, value);
					} else {
						Data = set_value(Data, name, 0);
					}
				} else {
					Data = set_value(Data, name, value);
				}
            }

            return Data;
        }
    },
	autocomplate: function(p) {
		// sample
		// Site.autocomplate({ action: 'pegawai' });
		
		// set default on select
		if (typeof(p.select) == 'undefined') {
			p.select = function(value) {
			}
		}
		
		// set default format
		if (typeof(p.format) == 'undefined') {
			p.format = function(row) {
				return row[0] + " (" + row[1] + ")";
			}
		}
		
		$(".auto-pegawai").autocomplete( Web.HOST + "/index.php/common/autocomplete", {
			delay: 1500,
			minChars:5,
			matchSubset:1,
			matchContains:1,
			cacheLength:10,
			autoFill: true,
			extraParams: { action: p.action },
			onItemSelect: p.select,
			onItemSelect: p.format,
			formatItem: p.format
		} );
	}
}

function IsValidEmail(Email) {
    var Match = Email.match(new RegExp('[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}', 'gi'));
    
    var Result = false;
    if (Match != null && Match[0] != null) {
        Result = true
    }
    return Result;
}

function ShowWarning(ArrayError) {
    if ($('#DialogConfirm p').length == 0) {
        $('body').prepend('<div id="DialogConfirm" title="Warning" style="display: none;"><p></p></div>');
    }
    
    if (ArrayError.length > 0) {
        var WarningMeasage = '';
        for (var i = 0; i < ArrayError.length; i++) {
            WarningMeasage += '<li>' + ArrayError[i] + '</li>';
        }
        
        if (typeof(ArrayError) == 'string') {
            $('#DialogConfirm p').html('<ul style="font-weight: 700;">' + ArrayError + '</ul>');
        } else {
            $('#DialogConfirm p').html('<ul style="font-weight: 700;">' + WarningMeasage + '</ul>');
        }
        
        $('#DialogConfirm').dialog({ modal: true });
        
        return false;
    }
    return true;
}

function ShowDialogObject(Param) {
    if (jQuery('#DialogObject').length == 1) {
        jQuery('#DialogObject').remove();
    }
    
    var Message = '';
    if (Param.ArrayMessage.length == 1) {
        Message = Param.ArrayMessage[0];
    } else {
        for (var i = 0; i < Param.ArrayMessage.length; i++) {
            Message += '<li>' + Param.ArrayMessage[i] + '</li>';
        }
        Message = '<ul>' + Message + '</ul>';
    }
    
    var ArrayButton = [];
    if (Param.ArrayButton != 'undefined') {
        ArrayButton = Param.ArrayButton;
    }
    
	Param.Title = (typeof(Param.Title) != 'undefined') ? Param.Title : 'Informasi';
	Param.Width = (typeof(Param.Width) != 'undefined') ? Param.Width : 300;
	Param.OnClose = (typeof(Param.OnClose) != 'undefined') ? Param.OnClose : null;
	
    jQuery('body').prepend('<div id="DialogObject" class="none">' + Message + '</div>');
    $('#DialogObject').dialog({ title: Param.Title, resizable: false, modal: true, buttons: ArrayButton, width: Param.Width, close: Param.OnClose });
}

function InitMainSite() {
	InitForm.InitUser();
	
	if ($('.MessagePopup').length == 1) {
		var Text = $('.MessagePopup').text();
		ShowDialogObject({
			ArrayMessage: [Text],
			ArrayButton: [ { text: "Ok", click: function() { $(this).dialog("close"); } } ]
		});
		$('.MessagePopup').remove();
	}
	
	if ($('input[type="file"]').length > 0) {
		var Length = $('input[type="file"]').length;
		for (var i = 0; i < Length; i++) {
			$('input[type="file"]').eq(i).parent('td').append('<div>Ukuran file maksimal 2 MB yang dapat diupload dengan tipe file jpg atau pdf</div>');
		}
	}
	
	if ($('input[name="UploadFile"]').length == 1) {
		var FormName = $('input[name="FormName"]').val();
		var ArrayForm = {
			PegawaiAktif: { ArrayData: ['K_PEGAWAI', 'K_AKTIF', 'NO_SK'] },
			RiwayatDiklat: { ArrayData: ['K_PEGAWAI_ENCRYPT', 'NO_SERTIFIKAT_ENCRYPT'] },
			RiwayatHonorer: { ArrayData: ['K_PEGAWAI', 'NO_SK'] },
			RiwayatJabatanStruktural: { ArrayData: ['K_PEGAWAI', 'NO_SK'] },
			RiwayatJabatanFungsional: { ArrayData: ['K_PEGAWAI', 'NO_SK'] },
			RiwayatPangkat: { ArrayData: ['K_PEGAWAI', 'NO_SK'] },
			RiwayatSertifikasi: { ArrayData: ['K_PEGAWAI', 'NO_SERTIFIKAT', 'NO_PESERTA'] },
			RiwayatPenghargaan: { ArrayData: ['K_PEGAWAI', 'NO_SK'] },
			RiwayatPendidikan: { ArrayData: ['K_PEGAWAI', 'K_JENJANG', 'NO_IJAZAH'] },
			RiwayatHomeBase: { ArrayData: ['ID_RIWAYAT_HOMEBASE'] },
			KenaikanGaji: { ArrayData: ['K_PEGAWAI', 'NO_SK'] }
		}
		
		$('input[name="UploadFile"]').click(function() {
			var LinkUpload = Web.HOST + '/index.php/UploadFile/index/' + FormName;
			for (var i = 0; i < ArrayForm[FormName].ArrayData.length; i++) {
				var input = false;
				if ($('input[name="' + ArrayForm[FormName].ArrayData[i] + '_HI"]').length == 1) {
					input = $('input[name="' + ArrayForm[FormName].ArrayData[i] + '_HI"]');
				} else {
					input = $('input[name="' + ArrayForm[FormName].ArrayData[i] + '"]');
				}
				
				LinkUpload += '/' + input.val();
			}
			
			jQuery('body').prepend('<div id="DialogUpload" class="none"><iframe src="' + LinkUpload + '" frameborder="0" height="100%" width="100%" marginheight="0px" marginwidth="0px"></iframe></div>');
			$('#DialogUpload').dialog({
				title: 'Upload File', resizable: false, modal: true,
				buttons: [ { text: "Tutup", click: function() { $(this).dialog("close"); } } ],
				width: 500, height: 400
			});
		});
		
		if (ArrayForm[FormName] != null) {
			var FieldInput = ArrayForm[FormName].ArrayData[0] + '_HI';
			if ($('input[name="' + FieldInput + '"]').val() == '') {
				$('input[name="UploadFile"]').parent('td').html('Upload file dapat dilakukan setelah data ini disimpan.');
			}
		}
	}
}

function InitTable() {
    if ($('#InitTable .Delete').length >= 1) {
        $('#InitTable .Delete').click(function() {
            if ($("#DialogConfirm p").length == 0) {
                $('body').prepend('<div id="DialogConfirm" class="none"><p></p></div>');
            }
            
            var Link = $(this).attr('href');
            $("#DialogConfirm p").html('Apa ada yakin akan menghapus data ini ?');
            
            $("#DialogConfirm").dialog({
                resizable: false, modal: true, height: 140,
                buttons: {
                    "Ya": function() {
                        window.location = Link;
                    },
                    'Tidak': function() {
                        $(this).dialog("close");
                    }
                },
                close: function() {
                    $("#DialogConfirm p").remove();
                }
            });
            
            return false;
        });
    }
}

function InitDeleteImage() {
    $('.Relative .position .cursor').click(function() {
        var Parent = $(this).parent('.position').parent('.Relative');
        var Object = {
            Action: 'Delete',
            ImageLink:
                (Parent.children('a').length == 1)
                ? Parent.children('a').eq(0).attr('href')
                : Parent.children('img').eq(0).attr('src')
        }
        
        $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/Image", data: Object,
            success: function(ContentHtml) {
                Parent.remove();
            }
        });
    });
}

function InitLaporan() {
    var ComboBox = {
            NamaLaporan: function() {
                var Object = {
                    Action: 'GetArrayNamaLaporan',
                    JenisLaporan : $('select[name="JenisLaporan"]').val()
                }
                $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/NamaLaporan", data: Object,
                    success: function(ContentHtml) {
                        $('select[name="NamaLaporan"]').html(ContentHtml);
                        Report.Filter();
                    }
                });
            }
        }
    
    var Report = {
        Filter: function() {
            var Object = {
                Action: 'GetLaporanFilter',
                JenisLaporan : $('select[name="JenisLaporan"]').val(),
                NamaLaporan : $('select[name="NamaLaporan"]').val()
            }
            $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/GetLaporanFilter", data: Object,
                success: function(ContentHtml) {
                    $('#CntReportFilter').html(ContentHtml);
					InitForm.Start('CntReportFilter');
                }
            });
        },
        RequestContent: function(Param) {
			var ArrayValidation = InitForm.Validation('CntLaporan');
			if (ArrayValidation.length > 0) {
				return false;
			}
			
			$.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/GetResultLaporan", data: Param,
				success: function(ContentHtml) {
					$('#ReportResult').html(ContentHtml);
					Report.InitExport();
					Report.InitPaging();
				}
			});
		},
		InitExport: function() {
            $('#PageFeature .Excel img').click(function() {
                var Data = InitForm.GetValue('CntLaporan');
                Data.Export = 1;
                Data.ExportType = 'Excel';
                Data.ExportName = 'LaporanPegawai';
                
                $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/ExportPegawai", data: Data,
                    success: function(RawResult) {
                        eval('var Result = ' + RawResult);
                        window.location = Result.LinkExcel;
                    }
                });
            });
        },
		InitPaging: function() {
			$('#PageFeature .Paging a').click(function() {
				var Param = InitForm.GetValue('CntLaporan');
				Param.Action = 'GetResultLaporan';
				Param.PageActive = $(this).text().trim();
				Report.RequestContent(Param);
			});
		}
    }
    
    $('select[name="JenisLaporan"]').change(function() {
        ComboBox.NamaLaporan();
    });
    $('select[name="NamaLaporan"]').change(function() {
        Report.Filter();
    });
    $('input[name="Submit"]').click(function() {
		if (jQuery('select[name="JenisLaporan"]').val() == '00') {
			return;
		}
		
		var Param = InitForm.GetValue('CntLaporan');
		Param.Action = 'GetResultLaporan';
		Param.PageActive = 1;
		Report.RequestContent(Param);
    });
    
    Report.Filter();
}

function InitLaporanEkd() {
    var DataFuntion = {
        DoSearch: function() {
            var Param = InitForm.Form.GetValue('CntLaporan');
            Param.Action = 'GetResultLaporan';
            
            $('#ReportResult').html('<div style="text-align: center;"><img src="' + Web.HOST + '/images/AjaxLoading.gif" /></div>');
            $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/GetResultLaporan", data: Param,
                success: function(ContentHtml) {
                    $('#ReportResult').html(ContentHtml);
                    DataFuntion.InitPaging();
					DataFuntion.InitGrid();
                }
            });
        },
        InitPaging: function() {
            $('#PagePegawai a').click(function() {
                $('input[name="PageActive"]').val($(this).text());
                DataFuntion.DoSearch();
            });
        },
		InitGrid: function() {
			$('.DialogKesimpulan').click(function() {
				var RawRecord = $(this).parent('td').children('span').text();
				eval('var Record = ' + RawRecord);
				
				// Convert to Standard Data
				Record.PD1 = (Record.PD1 == null) ? Record.PD_GANJIL : Record.PD1;
				Record.PD2 = (Record.PD2 == null) ? Record.PD_GENAP : Record.PD2;
				Record.PL1 = (Record.PL1 == null) ? Record.PL_GANJIL : Record.PL1;
				Record.PL2 = (Record.PL2 == null) ? Record.PL_GENAP : Record.PL2;
				Record.PG1 = (Record.PG1 == null) ? Record.PG_GANJIL : Record.PG1;
				Record.PG2 = (Record.PG2 == null) ? Record.PG_GENAP : Record.PG2;
				Record.PK1 = (Record.PK1 == null) ? Record.PK_GANJIL : Record.PK1;
				Record.PK2 = (Record.PK2 == null) ? Record.PK_GENAP : Record.PK2;
				Record.NIP = (Record.NIP == null) ? Record.K_PEGAWAI : Record.NIP;
				
				var Param = {
					PD1: parseFloat(Record.PD1), PD2: parseFloat(Record.PD2),
					PL1: parseFloat(Record.PL1), PL2: parseFloat(Record.PL2),
					PG: parseFloat(Record.PG1) + parseFloat(Record.PG2),
					PK: parseFloat(Record.PK1) + parseFloat(Record.PK2),
					ArrayAlasan: Record.ArrayAlasan,
					NIP: Record.NIP, NAMA: Record.NAMA, STATUS: Record.STATUS,
					NO_SERTIFIKAT: Record.NO_SERTIFIKAT, K_STATUS_DOSEN: Record.K_STATUS_DOSEN,
					TahunAkademik: $('select[name="TAHUN"] :selected').text()
				}
				var Template = DataFuntion.GetTemplate(Param);
				
				ShowDialogObject({
					Width: 600,
					ArrayMessage: [Template]
				});
			});
			
			$('.ListDosen').click(function() {
				var FormMain = InitForm.Form.GetValue('CntLaporan');
				var RawRecord = $(this).parent('td').children('span').text();
				eval('var Record = ' + RawRecord);
				
				var AjaxParam = {
					Action: 'GetResultLaporan',
					NamaLaporan: 'LaporanEkdAssessorActivityListDosen',
					TAHUN: FormMain.TAHUN,
					K_ASESOR: Record.K_ASESOR,
					K_SEMESTER: 0
				}
				$.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/GetResultLaporan", data: AjaxParam,
					success: function(ContentHtml) {
						
						ShowDialogObject({
							Width: 750, Title: 'Daftar Dosen yang diasessori oleh ' + Record.NAMA,
							ArrayMessage: [ContentHtml]
						});
					}
				});
			});
		},
		GetTemplate: function(Param) {
			Param.NO_SERTIFIKAT = (Param.NO_SERTIFIKAT == null) ? '-' : Param.NO_SERTIFIKAT;
			
			// Calculate Data
			Param.PD = Param.PD1 + Param.PD2;
			Param.PL = Param.PL1 + Param.PL2;
			Param.SksPendidikanPenelitian = Param.PD + Param.PL;
			Param.SksPengabdianTambahan = Param.PG + Param.PK;
			Param.SksTotal = Param.SksPendidikanPenelitian + Param.SksPengabdianTambahan;
			
			Param.PDString = Param.PD.toFixed(2);
			Param.PD1String = Param.PD1.toFixed(2);
			Param.PD2String = Param.PD2.toFixed(2);
			Param.PLString = Param.PL.toFixed(2);
			Param.PL1String = Param.PL1.toFixed(2);
			Param.PL2String = Param.PL2.toFixed(2);
			Param.PGString = Param.PG.toFixed(2);
			Param.PKString = Param.PK.toFixed(2);
			Param.SksPendidikanPenelitianString = Param.SksPendidikanPenelitian.toFixed(2);
			Param.SksPengabdianTambahanString = Param.SksPengabdianTambahan.toFixed(2);
			Param.SksTotalString = Param.SksTotal.toFixed(2);
			
			// Generate Conclusion
			Param.KesimpulanPengabdian = (Param.PG == 0) ? 'T' : 'M';
			Param.KesimpulanPendidikanPenelitian = (Param.SksPendidikanPenelitian < 18) ? 'T' : 'M';
			Param.KesimpulanPengabdianTambahan = (Param.SksPengabdianTambahan < 6) ? 'T' : 'M';
			
			var CntPendidikan = '';
			if (Param.K_STATUS_DOSEN == '03' || Param.K_STATUS_DOSEN == '04') {
				Param.KesimpulanPendidikanGanjil = (Param.PD1String == 0) ? 'T' : 'M';
				Param.KesimpulanPendidikanGenap = (Param.PD2String == 0) ? 'T' : 'M';
				Param.KesimpulanPendidikan = (Param.PD < 6) ? 'T' : 'M';
				CntPendidikan += '<tr><td>Pendidikan Semester Ganjil</td><td style="text-align: center;">Tidak boleh kosong</td><td style="text-align: center;">' + Param.PD1String + ' sks</td><td style="text-align: center;">' + Param.KesimpulanPendidikanGanjil + '</td></tr>';
				CntPendidikan += '<tr><td>Pendidikan Semester Genap</td><td style="text-align: center;">Tidak boleh kosong</td><td style="text-align: center;">' + Param.PD2String + ' sks</td><td style="text-align: center;">' + Param.KesimpulanPendidikanGenap + '</td></tr>';
				CntPendidikan += '<tr><td>Pendidikan</td><td style="text-align: center;">Min. 6 sks</td><td style="text-align: center;">' + Param.PDString + ' sks</td><td style="text-align: center;">' + Param.KesimpulanPendidikan + '</td></tr>';
			} else {
				Param.KesimpulanPendidikanGanjil = (Param.PD1String == 0) ? 'T' : 'M';
				Param.KesimpulanPendidikanGenap = (Param.PD2String == 0) ? 'T' : 'M';
				Param.KesimpulanPendidikan = (Param.KesimpulanPendidikanGanjil == 'M' && Param.KesimpulanPendidikanGenap == 'M') ? 'M' : 'T';
				CntPendidikan += '<tr><td>Pendidikan Semester Ganjil</td><td style="text-align: center;">Tidak boleh kosong</td><td style="text-align: center;">' + Param.PD1String + ' sks</td><td style="text-align: center;">' + Param.KesimpulanPendidikanGanjil + '</td></tr>';
				CntPendidikan += '<tr><td>Pendidikan Semester Genap</td><td style="text-align: center;">Tidak boleh kosong</td><td style="text-align: center;">' + Param.PD2String + ' sks</td><td style="text-align: center;">' + Param.KesimpulanPendidikanGenap + '</td></tr>';
				CntPendidikan += '<tr><td>Pendidikan</td><td style="text-align: center;">&nbsp;</td><td style="text-align: center;">' + Param.PDString + ' sks</td><td style="text-align: center;">' + Param.KesimpulanPendidikan + '</td></tr>';
			}
			
			var CntPenelitian = '';
			if (Param.K_STATUS_DOSEN == '03' || Param.K_STATUS_DOSEN == '04') {
				CntPenelitian = '<tr><td>Penelitian</td><td style="text-align: center;">-</td><td style="text-align: center;">' + Param.PLString + ' sks</td><td style="text-align: center;">M</td></tr>';
			} else {
				Param.KesimpulanPenelitianGanjil = (Param.PL1 > 0) ? 'M' : 'T';
				Param.KesimpulanPenelitianGenap = (Param.PL2 > 0) ? 'M' : 'T';
				Param.KesimpulanPenelitian = (Param.KesimpulanPenelitianGanjil == 'M' && Param.KesimpulanPenelitianGenap == 'M') ? 'M' : 'T';
				CntPenelitian += '<tr><td>Penelitian Semester Ganjil</td><td style="text-align: center;">Tidak boleh kosong</td><td style="text-align: center;">' + Param.PL1String + ' sks</td><td style="text-align: center;">' + Param.KesimpulanPenelitianGanjil + '</td></tr>';
				CntPenelitian += '<tr><td>Penelitian Semester Genap</td><td style="text-align: center;">Tidak boleh kosong</td><td style="text-align: center;">' + Param.PL2String + ' sks</td><td style="text-align: center;">' + Param.KesimpulanPenelitianGenap + '</td></tr>';
				CntPenelitian += '<tr><td>Penelitian</td><td style="text-align: center;">&nbsp;</td><td style="text-align: center;">' + Param.PLString + ' sks</td><td style="text-align: center;">' + Param.KesimpulanPenelitian + '</td></tr>';
			}
			
			var CntPenunjang = '';
			if (Param.K_STATUS_DOSEN == '03' || Param.K_STATUS_DOSEN == '04') {
				CntPenunjang = '<tr><td>Penunjang</td><td style="text-align: center;">-</td><td style="text-align: center;">' + Param.PKString + ' sks</td><td style="text-align: center;">M</td></tr>';
			} else {
				Param.KesimpulanPenunjang = 'M';
				CntPenunjang = '<tr><td>Penunjang</td><td style="text-align: center;">-</td><td style="text-align: center;">' + Param.PKString + ' sks</td><td style="text-align: center;">' + Param.KesimpulanPenunjang + '</td></tr>';
			}
			
			var CntPengabdian = '';
			if (Param.K_STATUS_DOSEN == '01' || Param.K_STATUS_DOSEN == '02') {
				CntPengabdian = '<tr><td>Pengabdian</td><td style="text-align: center;">Tidak boleh kosong</td><td style="text-align: center;">' + Param.PGString + ' sks</td><td style="text-align: center;">' + Param.KesimpulanPengabdian + '</td></tr>';
			} else if (Param.K_STATUS_DOSEN == '03' || Param.K_STATUS_DOSEN == '04') {
				CntPengabdian = '<tr><td>Pengabdian</td><td style="text-align: center;">-</td><td style="text-align: center;">' + Param.PGString + ' sks</td><td style="text-align: center;">M</td></tr>';
			}
			
			var CntPendidikanPenelitian = '';
			if (Param.K_STATUS_DOSEN != '03' && Param.K_STATUS_DOSEN != '04') {
				CntPendidikanPenelitian = '<tr><td>Pendidikan + Penelitian</td><td style="text-align: center;">Min. 18 sks</td><td style="text-align: center;">' + Param.SksPendidikanPenelitianString + ' sks</td><td style="text-align: center;">' + Param.KesimpulanPendidikanPenelitian + '</td></tr>';
			}
			
			var CntPengabdianPenunjang = '';
			if (Param.K_STATUS_DOSEN != '03' && Param.K_STATUS_DOSEN != '04') {
				CntPengabdianPenunjang = '<tr><td>Pengabdian + Penunjang</td><td style="text-align: center;">Min. 6 sks</td><td style="text-align: center;">' + Param.SksPengabdianTambahanString + ' sks</td><td style="text-align: center;">' + Param.KesimpulanPengabdianTambahan + '</td></tr>';
			}
			
			var CntTotalKinerja = '';
			if (Param.K_STATUS_DOSEN == '03' || Param.K_STATUS_DOSEN == '04') {
				Param.KesimpulanTotal = (Param.SksTotal < 6 || Param.SksTotal > 32) ? 'T' : 'M';
				CntTotalKinerja = '<tr><td>Total Kinerja</td><td style="text-align: center;">Min. 6 sks, Max. 32 sks</td><td style="text-align: center;">' + Param.SksTotalString + ' sks</td><td style="text-align: center;">' + Param.KesimpulanTotal + '</td></tr>';
			} else {
				Param.KesimpulanTotal = (Param.SksTotal < 24 || Param.SksTotal > 32) ? 'T' : 'M';
				CntTotalKinerja = '<tr><td>Total Kinerja</td><td style="text-align: center;">Min. 24 sks, Max. 32 sks</td><td style="text-align: center;">' + Param.SksTotalString + ' sks</td><td style="text-align: center;">' + Param.KesimpulanTotal + '</td></tr>';
			}
			
			var TableNote = '';
			if ($('input[name="NamaLaporan"]').val() == 'LaporanEkd') {
				TableNote = '';
			} else if (Param.K_STATUS_DOSEN == '02' || Param.K_STATUS_DOSEN == '04') {
				TableNote += 'Dalam 3 tahun wajib menyelesaikan 3 jenis kewajiban khusus :<br />';
				TableNote += '1. Menulis buku minimal 3 sks<br />';
				TableNote += '2. Membuat karya ilmiah minimal 3 sks<br />';
				TableNote += '3. Menyebarluaskan gagasan minimal 3 sks';
				
				var ValueTemp1 = ValueTemp2 = ValueTemp3 = '0.00';
				if (Param.ArrayAlasan != null) {
					ValueTemp1 = (Param.ArrayAlasan[3] == null) ? '0.00' : Param.ArrayAlasan[3][1];
					ValueTemp2 = (Param.ArrayAlasan[4] == null) ? '0.00' : Param.ArrayAlasan[4][1];
					ValueTemp3 = (Param.ArrayAlasan[5] == null) ? '0.00' : Param.ArrayAlasan[5][1];
				}
				
				TableNote += '<div style="padding: 10px 0;"><table style="font-size: 10px;" border="1" cellspacing="0">';
				TableNote += '<tr><td style="text-align: center; width: 40px;">No</td><td style="width: 385px;">Jenis Kewajiban Khusus</td><td style="text-align: center; width: 100px;">Realisasi SKS</td></tr>';
				TableNote += '<tr><td style="text-align: center;">1</td><td>Menulis buku minimal 3 sks</td><td style="text-align: center;">' + ValueTemp1 + '</td></tr>';
				TableNote += '<tr><td style="text-align: center;">2</td><td>Membuat karya ilmiah minimal 3 sks</td><td style="text-align: center;">' + ValueTemp2 + '</td></tr>';
				TableNote += '<tr><td style="text-align: center;">3</td><td>Menyebarluaskan gagasan minimal 3 sks</td><td style="text-align: center;">' + ValueTemp3 + '</td></tr>';
				TableNote += '</table></div>';
			}
			
			var Template = '<style>#NilaiEkdDialog table td { padding: 3px; }</style>';
			Template += '<div style="float: left; width: 125px;">NIP / No Sertifikat</div>';
			Template += '<div style="float: left; width: 250px;">: ' + Param.NIP + ' / ' + Param.NO_SERTIFIKAT + '</div>';
			Template += '<div class="clear"></div>';
			Template += '<div style="float: left; width: 125px;">Nama Lengkap</div>';
			Template += '<div style="float: left; width: 250px;">: ' + Param.NAMA + '</div>';
			Template += '<div class="clear"></div>';
			Template += '<div style="float: left; width: 125px;">Nama Status</div>';
			Template += '<div style="float: left; width: 250px;">: ' + Param.STATUS + '</div>';
			Template += '<div class="clear"></div>';
			Template += '<div style="float: left; width: 125px;">Tahun Akademik</div>';
			Template += '<div style="float: left; width: 250px;">: ' + Param.TahunAkademik + '</div>';
			Template += '<div class="clear"></div>';
			Template += '<div id="NilaiEkdDialog">';
			Template += '<div style="padding: 10px 0;"><table style="font-size: 10px;" border="1" cellspacing="0">';
			Template += '<tr style="text-align: center;"><td style="width: 160px;">Keterangan</td><td style="width: 160px;">Syarat</td><td style="width: 100px;">Kinerja</td><td style="width: 100px;">Kesimpulan</td></tr>';
			Template += CntPendidikan;
			Template += CntPenelitian;
			Template += CntPengabdian;
			Template += CntPenunjang;
			Template += CntPendidikanPenelitian;
			Template += CntPengabdianPenunjang;
			Template += CntTotalKinerja;
			Template += '</table></div>';
			Template += TableNote;
			Template += '</div>';
			
			return Template;
		}
    }
    
    $('input[name="Submit"]').click(function() {
        $('input[name="PageActive"]').val('1');
        DataFuntion.DoSearch();
    });
}

function InitRiwayatPendidikan() {
    InitForm.Start('FormRiwayatPendidikan');
    
    var ComboBox = {
        Jenjang: function() {
            var Value = $('select[name="K_JENJANG"]').val();
            if (Value == '1' || Value == '2' || Value == '3' || Value == '4' || Value == '5' || Value == '6') {
                $('#CntIpk').hide();
                $('#CntProgramStudy').hide();
            } else {
                $('#CntIpk').show();
                $('#CntProgramStudy').show();
            }
			
			if (Value == '03') {
                $('#CntAsalPT').show();
			} else {
                $('#CntAsalPT').hide();
			}
        }
    }
    
    var ParameterUpdate = $('input[name="ParameterUpdate"]').val();
    if (ParameterUpdate == 'update') {
        var K_JENJANG = $('select[name="K_JENJANG"]').val();
        $('select[name="K_JENJANG"]').change(function() {
            $('select[name="K_JENJANG"]').val(K_JENJANG);
        });
    }
    
    $('#FormRiwayatPendidikan form').submit(function() {
        // Validation
        var ArrayError = [];
		
        if ($('input[name="THN_MASUK"]').val().length != 4) {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Tahun Masuk';
        }
		/*
        if ($('input[name="PT"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan PT';
        }
		/*	*/
        
        return ShowWarning(ArrayError);
    });
    
    $('select[name="K_JENJANG"]').change(function() { ComboBox.Jenjang(); });
    
    ComboBox.Jenjang();
}

function RiwayatPangkat() {
    InitForm.Start('FormRiwayatPangkat');
	
	var Func = {
		Penjelasan: function() {
			var k_penjelasan = $('select[name="K_PENJELASAN"]').val();
			if (k_penjelasan == '01') {
				$('.CntMasaKerjaTambahan').show();
			} else {
				$('.CntMasaKerjaTambahan').hide();
				$('input[name="MASA_JABATAN_TAMBAHAN"]').val('');
			}
		}
	}
    
    var ParameterUpdate = $('input[name="ParameterUpdate"]').val();
    if (ParameterUpdate == 'update') {
        $('input[name="NO_SK"]').attr('readonly', 'readonly');
    }
    
	$('select[name="K_PENJELASAN"]').change(function() {
		Func.Penjelasan();
	});
	
    $('#FormRiwayatPangkat form').submit(function() {
        // Validation
        var ArrayError = [];
        
        if ($('input[name="NO_SK"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan No SK';
        }
        if ($('input[name="TGL_SK"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Tanggal SK';
        }
        if ($('input[name="TMT"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Tanggal TMT';
        }
        if ($('input[name="TGL_SELESAI"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Tanggal Selesai';
        }
        if ($('input[name="TGL_SERTIFIKAT"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Tanggal Sertifikat';
        }
        
        return ShowWarning(ArrayError);
    });
	
	Func.Penjelasan();
}

function InitPegawai() {
    InitForm.Start('FormPegawaiEntry');
    var ComboBox = {
		K_KOTA_ASAL: function() {
			var Param = {
				Action: 'GetKotaByPropinsiID',
				K_NEGARA: $('input[name="K_NEGARA_ASAL"]').val(),
				K_PROPINSI: $('select[name="K_PROPINSI_ASAL"]').val()
			};
			$.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/Kota", data: Param,
                success: function(ContentHtml) {
                    $('select[name="K_KOTA_ASAL"]').html(ContentHtml);
                }
            });
		},
        K_STATUS_KERJA: function() {
            var K_STATUS_KERJA = $('select[name="K_STATUS_KERJA"]').val();
            if (K_STATUS_KERJA == '01') {
                $('#CntKarpeg').show();
                $('#CntMasaKerjaGolongan').show();
                $('#CntTmtCpns').show();
                $('#CntNoSkCpns').show();
                $('#CntTmtPns').show();
                $('#CntNoSkPns').show();
                $('#CntNik').show();
            } else {
                $('#CntKarpeg').hide();
                $('#CntMasaKerjaGolongan').hide();
                $('#CntTmtCpns').hide();
                $('#CntNoSkCpns').hide();
                $('#CntTmtPns').hide();
                $('#CntNoSkPns').hide();
                $('#CntNik').hide();
            }
        },
        K_JENIS_KERJA: function() {
            var K_JENIS_KERJA = $('select[name="K_JENIS_KERJA"]').val();
            if (K_JENIS_KERJA == '01') {
                $('#CntStatusDosen').show();
                $('#CntNidn').show();
                $('#CntNira').show();
            } else {
                $('#CntStatusDosen').hide();
                $('#CntNidn').hide();
                $('#CntNira').hide();
            }
        }
    }
    var DataFunction = {
		InitForm: function() {
			var IsUserFakultas = $('input[name="IsUserFakultas"]').val();
			if (IsUserFakultas == '1') {
				$('input[name="NO_ODNER"]').attr('readonly', true);
			}
			
			if ($('select[name="K_KOTA_ASAL"]').val() == null) {
				ComboBox.K_KOTA_ASAL();
			}
		}
	}
	
    $('#FormPegawaiEntry form').submit(function() {
        // Validation
        var ArrayError = [];
        var TahunMasuk = $('input[name="THN_MASUK"]').val();
        
        if ($('input[name="K_PEGAWAI"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan NIP';
        }
        if ($('input[name="NAMA"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Name';
        }
        if ($('input[name="TMP_LAHIR"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Tempat Lahir';
        }
        if ($('input[name="TGL_LAHIR"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Tanggal Lahir';
        }
        if ($('input[name="TGL_LAHIR"]').val().length != 10) {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Tanggal Lahir sesuai format.';
        }
        if ($('textarea[name="ALAMAT"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Alamat';
        }
        if ($('input[name="KARPEG"]').val() == '' && $('select[name="K_STATUS_KERJA"]').val() == '01') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Karpeg';
        }
        if ($('input[name="EMAIL"]').val() != '' && ! IsValidEmail($('input[name="EMAIL"]').val())) {
            ArrayError[ArrayError.length] = 'Email tidak sesuai';
        }
        if (TahunMasuk.length != 4) {
            ArrayError[ArrayError.length] = 'Silahkan memasukan Tahun Masuk yang sesuai.';
        }
        if (TahunMasuk < 1900 || TahunMasuk > new Date().getFullYear()) {
            ArrayError[ArrayError.length] = 'Silahkan memasukan Tahun Masuk diantara tahun 1900 dan tahun sekarang.';
        }
        
        var Result = ShowWarning(ArrayError);
		if (Result) {
			$('input[name="NO_ODNER"]').attr('readonly', false);
		}
		
		return Result;
    });
    
    $('select[name="K_STATUS_KERJA"]').change(function() { ComboBox.K_STATUS_KERJA(); });
    $('select[name="K_JENIS_KERJA"]').change(function() { ComboBox.K_JENIS_KERJA(); });
	$('select[name="K_PROPINSI_ASAL"]').change(function() { ComboBox.K_KOTA_ASAL(); });
    ($('input[name="IsNewPegawai"]').val() == '0') ? $('input[name="K_PEGAWAI"]').attr('readonly', true) : $('input[name="K_PEGAWAI"]').attr('readonly', false);
    ComboBox.K_STATUS_KERJA();
    ComboBox.K_JENIS_KERJA();
	
	DataFunction.InitForm();
	CheckSubMenu();
}

function IntPegawaiActive() {
    InitForm.Start('FormPegawaiAktif');
    
	$('select[name="K_AKTIF"]').change(function() {
		if ($('select[name="K_AKTIF"]').val() == '02') {
			$('.SubStudiLanjut').show();
		} else {
			$('.SubStudiLanjut').hide();
		}
	});
	$('select[name="K_AKTIF"]').change();
	
    var ParameterUpdate = $('input[name="ParameterUpdate"]').val();
    if (ParameterUpdate == 'update') {
        var K_AKTIF = $('select[name="K_AKTIF"]').val();
        $('input[name="NO_SK"]').attr('readonly', 'readonly');
        $('select[name="K_AKTIF"]').change(function() {
            $('select[name="K_AKTIF"]').val(K_AKTIF);
        });
    }
    
    $('#FormPegawaiAktif form').submit(function() {
        var ArrayError = InitForm.Validation('FormPegawaiAktif');
        
        var TGL_MULAI = InitForm.GetTimeFromString($('input[name="TGL_MULAI"]').val());
        var TGL_SELESAI = InitForm.GetTimeFromString($('input[name="TGL_SELESAI"]').val());
        if (TGL_MULAI > TGL_SELESAI) {
            ArrayError[ArrayError.length] = 'Tanggal Mulai harus lebih kecil daripada Tanggal Selesai';
        }
        
        var Result = ShowWarning(ArrayError);
        return Result;
    });
}

function InitRiwayatFungsional() {
    InitForm.Start('FormRiwayatFungsional');
    
    var ComboBox = {
        Jenjang: function() {
            if ($('select[name="K_UNIT_KERJA"]').length == 0) {
                return;
            }
            
            var Object = {
                Action: 'GetJenjangByUnitKerja',
                K_UNIT_KERJA : $('select[name="K_UNIT_KERJA"]').val()
            }
            $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/Jenjang", data: Object,
                success: function(ContentHtml) {
                    $('select[name="K_JENJANG"]').html(ContentHtml);
                    ComboBox.Fakultas();
                }
            });
        },
        Fakultas: function() {
            var Object = {
                Action: 'GetFakultasByJenjangUnitKerja',
                K_JENJANG : $('select[name="K_JENJANG"]').val(),
                K_UNIT_KERJA: $('select[name="K_UNIT_KERJA"]').val()
            }
            $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/Fakultas", data: Object,
                success: function(ContentHtml) {
                    $('select[name="K_FAKULTAS"]').html(ContentHtml);
                    ComboBox.Jurusan();
                }
            });
        },
        Jurusan: function() {
            var Object = {
                Action: 'GetJurusanById',
                K_JENJANG : $('select[name="K_JENJANG"]').val(),
                K_FAKULTAS : $('select[name="K_FAKULTAS"]').val()
            }
            $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/Jurusan", data: Object,
                success: function(ContentHtml) {
                    $('select[name="K_JURUSAN"]').html(ContentHtml);
                    ComboBox.ProgramStudy();
                }
            });
        },
        ProgramStudy: function() {
            var Object = {
                Action: 'GetProgramStudiById',
                K_JENJANG : $('select[name="K_JENJANG"]').val(),
                K_FAKULTAS : $('select[name="K_FAKULTAS"]').val(),
                K_JURUSAN : $('select[name="K_JURUSAN"]').val()
            }
            $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/ProgramStudi", data: Object,
                success: function(ContentHtml) {
                    $('select[name="K_PROG_STUDI"]').html(ContentHtml);
                }
            });
        },
        BidangIlmu: function() {
            var JabatanFungsional = $('select[name="K_JABATAN_FUNGSIONAL"]').val();
            
            if (JabatanFungsional == '03' || JabatanFungsional == '04') {
                $('#CntBidangIlmu').show();
            } else {
                $('#CntBidangIlmu').hide();
            }
        }
    }
    
    $('select[name="K_UNIT_KERJA"]').change(function() { ComboBox.Jenjang(); });
    $('select[name="K_JENJANG"]').change(function() { ComboBox.Fakultas(); });
    $('select[name="K_FAKULTAS"]').change(function() { ComboBox.Jurusan(); });
    $('select[name="K_JURUSAN"]').change(function() { ComboBox.ProgramStudy(); });
    $('select[name="K_JABATAN_FUNGSIONAL"]').change(function() { ComboBox.BidangIlmu(); });
    
    var ParameterUpdate = $('input[name="ParameterUpdate"]').val();
    if (ParameterUpdate == 'update') {
        $('input[name="NO_SK"]').attr('readonly', 'readonly');
    }
    
    $('#FormRiwayatFungsional form').submit(function() {
        // Validation
        var ArrayError = [];
        
        if ($('input[name="NO_SK"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan No SK';
        }
        if ($('input[name="TGL_SK"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Tanggal SK';
        }
        if ($('input[name="TMT"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Tanggal TMT';
        }
        
        return ShowWarning(ArrayError);
    });
    
    if ($('input[name="ParameterUpdate"]').val() == 'insert') {
        ComboBox.Jenjang();
    }
    
    ComboBox.BidangIlmu();
}

function InitRiwayatSertifikasi() {
    InitForm.Start('FormRiwayatSertifikasi');
    
    $('#FormRiwayatSertifikasi form').submit(function() {
        var ArrayError = InitForm.Validation('FormRiwayatSertifikasi');
        var Result = ShowWarning(ArrayError);
        
        return Result;
    });
    
    var ParameterUpdate = $('input[name="ParameterUpdate"]').val();
    if (ParameterUpdate == 'update') {
        $('input[name="NO_SERTIFIKAT"]').attr('readonly', 'readonly');
        $('input[name="NO_PESERTA"]').attr('readonly', 'readonly');
    }
}

function InitRiwayatKeluarga() {
    InitForm.Start('FormRiwayatKeluarga');
    
    var Form = {
        K_Keluarga: function() {
            var Value = $('select[name="K_KELUARGA"]').val();
            if (Value == '01' || Value == '02') {
                $('.CntTanggalNikah').show();
            } else {
                $('.CntTanggalNikah').hide();
            }
        }
    }
    
    $('#FormRiwayatKeluarga form').submit(function() {
        var ArrayError = InitForm.Validation('FormRiwayatKeluarga');
        var Result = ShowWarning(ArrayError);
        
        return Result;
    });
    
    $('select[name="K_KELUARGA"]').change(function() { Form.K_Keluarga(); });
    Form.K_Keluarga();
}

function InitAsessor() {
    var InputButton = null;
    var DataFunction = {
        InitList: function() {
            jQuery('#PagePegawai a').click(function() {
                var Data = InitForm.GetValue('AsessorSearch');
                Data.Action = 'GetListPegawai';
                Data.PageActive = $(this).text();
                
                jQuery.post(Web.HOST + "/index.php/Asessor/Ajax", Data, function(RawText) {
                    jQuery('#ListAsessor').html(RawText);
                    DataFunction.InitList();
                });
            });
            
            jQuery('input[name="AssessorSimpan"]').click(function() {
                var ArrayError = InitForm.Validation('AsessorEntry');
                var Data = InitForm.GetValue('AsessorEntry');
                Data.Action = 'SetAssessor';
                
                var AssessorCheck = '';
                for (var i = 0; i < jQuery('input[name="AssessorCheck"]').length; i++) {
                    if (jQuery('input[name="AssessorCheck"]').eq(i).attr('checked')) {
                        AssessorCheck += (AssessorCheck == '') ? jQuery('input[name="AssessorCheck"]').eq(i).val() : ',' + jQuery('input[name="AssessorCheck"]').eq(i).val();
                    }
                }
                Data.ArrayAssessor = AssessorCheck;
                
                if (Data.ArrayAssessor == '') {
                    ArrayError[ArrayError.length] = 'Tolong memilih dosen yang dipilih terlebih dahulu.';
                }
                if (! ShowWarning(ArrayError)) {
                    return;
                }
                
                jQuery.post(Web.HOST + "/index.php/Asessor/Ajax", Data, function(RawText) {
                    eval('var ResultQuery = ' + RawText);
                    ShowWarning(ResultQuery.Message);
                    
                    var ArraySuccess = ArrayFail = [];
                    if (ResultQuery.Success != '') {
                        ArraySuccess = ResultQuery.Success.split(';,;');
                        for (var i = 0; i < ArraySuccess.length; i++) {
                            DataFunction.ShowSubMessage(true, ArraySuccess[i]);
                        }
                    }
                    if (ResultQuery.Fail != '') {
                        ArrayFail = ResultQuery.Fail.split(';,;');
                        for (var i = 0; i < ArrayFail.length; i++) {
                            DataFunction.ShowSubMessage(false, ArrayFail[i]);
                        }
                    }
                });
            });
        },
        ShowSubMessage: function(IsSuccecc, StringTemp) {
            var ArrayTemp = StringTemp.split(';.;');
            var Nip = ArrayTemp[0];
            var Message = ArrayTemp[1];
            var InputClass = jQuery('input[value="' + Nip + '"]').attr('class');
            jQuery('div.' + InputClass).html(Message);
            
            if (IsSuccecc) {
                jQuery('div.' + InputClass).attr('style', 'color: #000000;');
            } else {
                jQuery('div.' + InputClass).attr('style', 'color: #FF0000;');
            }
        }
    }
    
    jQuery('input[name="CariPegawai"]').click(function() {
        var Data = InitForm.GetValue('AsessorSearch');
        Data.Action = 'GetListPegawai';
        
        jQuery.post(Web.HOST + "/index.php/Asessor/Ajax", Data, function(RawText) {
            jQuery('#ListAsessor').html(RawText);
            DataFunction.InitList();
        });
    });
    
    jQuery('.PopupAsessor').click(function() {
        InputButton = $(this);
        
        $('#DialogSearchAsessor').dialog({
            modal: true, width: 500, height: 480,
            close: function(event, ui) {
                $('input[name="NamaAsessor"]').val('');
                $('#ResultAsessor').html('');
            }
        });
    });
    
    $('input[name="SearchAsessor"]').click(function() {
        var NamaAsessor = $('input[name="NamaAsessor"]').val();
        if (NamaAsessor.length == 0) {
            return;
        }
        
        jQuery.post(Web.HOST + "/index.php/DataAsessor/Ajax", { RequestAjax: 'PencarianDosenAsessor', NamaAsessor: NamaAsessor }, function(RawText) {
            $('#ResultAsessor').html(RawText);
            
            $('.Record').click(function() {
                var Nip = $(this).children('div').eq(0).text();
                var Name = $(this).children('div').eq(1).text();
                var Nip1 = $('input[name="NIP_0"]').val();
                var Nip2 = $('input[name="NIP_1"]').val();
                
                if (Nip == Nip1 || Nip == Nip2) {
                    return;
                }
                
                if (InputButton.hasClass('SearchAsessor1')) {
                    $('input[name="NIP_0"]').val(Nip);
                    $('input[name="NAMA_0"]').val(Name);
                } else {
                    $('input[name="NIP_1"]').val(Nip);
                    $('input[name="NAMA_1"]').val(Name);
                }
                
                $('#DialogSearchAsessor').dialog("close");
            });
        });
    });
    
    InitForm.Start('AsessorEntry');
}

function InitMessageModule() {
    InitForm.Start('CntPesanForm');
    
    var DataFunction = {
        InitPaging: function() {
            $('#PagePegawai a').click(function() {
                var Page = $(this).text();
                $('input[name="PageActive"]').val(Page);
                $('#CntPesanForm form').submit();
            });
        }
    }
    
    DataFunction.InitPaging();
}

function CheckSubMenu() {
    var Length = jQuery('.glossymenu').length;
    for (var i = 0; i < Length; i++) {
        if (jQuery('.glossymenu').eq(i).text() == '') {
            jQuery('.glossymenu').eq(i).remove();
        }
    }
}

function IntDataAsessor() {
    var InputButton = null;
    InitForm.Start('FormDataAsessor');
    
    $('.PopupAsessor').click(function() {
        InputButton = $(this);
        
        $('#DialogSearchAsessor').dialog({
            modal: true, width: 500, height: 480,
            close: function(event, ui) {
                $('input[name="NamaAsessor"]').val('');
                $('#ResultAsessor').html('');
            }
        });
    });
    
    $('input[name="SearchAsessor"]').click(function() {
        var NamaAsessor = $('input[name="NamaAsessor"]').val();
        if (NamaAsessor.length == 0) {
            return;
        }
        
        jQuery.post(Web.HOST + "/index.php/DataAsessor/Ajax", { RequestAjax: 'PencarianDosenAsessor', NamaAsessor: NamaAsessor }, function(RawText) {
            $('#ResultAsessor').html(RawText);
            
            $('.Record').click(function() {
                var Nip = $(this).children('div').eq(0).text();
                var Name = $(this).children('div').eq(1).text();
                var Nip1 = $('input[name="K_ASESOR_I"]').val();
                var Nip2 = $('input[name="K_ASESOR_II"]').val();
                
                if (Nip == Nip1 || Nip == Nip2) {
                    return;
                }
                
                if (InputButton.hasClass('SearchAsessor1')) {
                    $('input[name="K_ASESOR_I"]').val(Nip);
                    $('input[name="K_ASESOR_I_NAME"]').val(Name);
                } else {
                    $('input[name="K_ASESOR_II"]').val(Nip);
                    $('input[name="K_ASESOR_II_NAME"]').val(Name);
                }
                
                $('#DialogSearchAsessor').dialog("close");
            });
        });
    });
    
    $('#FormDataAsessor form').submit(function() {
        var ArrayError = InitForm.Validation('FormDataAsessor');
        var Result = ShowWarning(ArrayError);
        
        if (Result) {
            for(var i = 0; i < $('.required').length; i++) {
                $('.required').eq(i).attr('readonly', '');
            }
        }
        
        return Result;
    });
    
    if ($('input[name="ParameterUpdate"]').val() == 'update') {
        var THN_AKADEMIK = $('select[name="THN_AKADEMIK"]').val();
        $('select[name="THN_AKADEMIK"]').change(function() {
            $('select[name="THN_AKADEMIK"]').val(THN_AKADEMIK);
        });
        var IS_GANJIL = $('select[name="IS_GANJIL"]').val();
        $('select[name="IS_GANJIL"]').change(function() {
            $('select[name="IS_GANJIL"]').val(IS_GANJIL);
        });
    }
}

function InitPegawaiBioDataCetak() {
    var View = {
        StatusKerja: function(Value) {
            if (Value == '01') {
                $('#CntKarpeg').show();
                $('#CntMasaKerjaGolongan').show();
                $('#CntTmtCpns').show();
                $('#CntNoSkCpns').show();
                $('#CntTmtPns').show();
                $('#CntNoSkPns').show();
                $('#CntNik').show();
            } else {
                $('#CntKarpeg').hide();
                $('#CntMasaKerjaGolongan').hide();
                $('#CntTmtCpns').hide();
                $('#CntNoSkCpns').hide();
                $('#CntTmtPns').hide();
                $('#CntNoSkPns').hide();
                $('#CntNik').hide();
            }
        },
        JenisKerja: function(Value) {
            if (Value == '01') {
                $('#CntStatusDosen').show();
                $('#CntNidn').show();
                $('#CntNira').show();
            } else {
                $('#CntStatusDosen').hide();
                $('#CntNidn').hide();
                $('#CntNira').hide();
            }
            
        }
    }
    
    View.StatusKerja($('input[name="K_STATUS_KERJA"]').val());
    View.JenisKerja($('input[name="K_JENIS_KERJA"]').val());
}

function InitKenaikanGaji() {
    InitForm.Start('FormKenaikanGaji');
	
    $('#FormKenaikanGaji form').submit(function() {
        var ArrayError = InitForm.Validation('FormRiwayatKeluarga');
        var Result = ShowWarning(ArrayError);
        
        return Result;
    });
	
    var ParameterUpdate = $('input[name="ParameterUpdate"]').val();
    if (ParameterUpdate == 'update') {
        $('input[name="NO_SK"]').attr('readonly', 'readonly');
    }
}