var DATE_FORMAT = 'd-m-Y';
var TIME_FORMAT = 'H:i';

var Func = {
	Ajax: function(p) {
		p.is_json = (p.is_json == null) ? true : p.is_json;
		
		$.ajax({ type: 'POST', url: p.url, data: p.param }).done(function(temp) {
			if (p.is_json) {
				// continue here
//				eval('var result = ' + temp.responseText);
//				p.callback(result);
			} else {
				p.callback(temp);
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
	GetName: function(value) {
		var result = value.trim().replace(new RegExp(/[^0-9a-z]+/gi), '_').toLowerCase();
		return result;
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
	SwapDate: function(Value) {
		if (Value == null) {
			return '';
		}

		var ArrayValue = Value.split('-');
		if (ArrayValue.length != 3) {
			return '';
		}

		return ArrayValue[2] + '-' + ArrayValue[1] + '-' + ArrayValue[0];
	},
	SetValue: function(Param) {
		// Func.SetValue({ Action : 'City', ForceID: Param.city_id, Combo: WinGateway.city });

		Ext.Ajax.request({
			url: Web.HOST + '/index.php/combo',
			params: { Action : Param.Action, ForceID: Param.ForceID },
			success: function(Result) {
				Param.Combo.store.loadData(eval(Result.responseText));
				Param.Combo.setValue(Param.ForceID);
			}
		});
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
	},
	populate: function(p) {
		for (var form_name in p.record) {
			if (p.record.hasOwnProperty(form_name)) {
				var input = $(p.cnt + ' [name="' + form_name + '"]');
				var value = p.record[form_name];
				if (input.hasClass('datepicker')) {
					input.val(Func.SwapDate(value));
				} else {
					input.val(value);
				}
			}
		}
	}
}

var Renderer = {
	GetDateFromString: {
		Date: function(Value) {
			if (Value.length < 10) {
				return '';
			}

			var RawValue = Value.substr(0, 10);
			if (RawValue == '0000-00-00') {
				return '';
			}

			return RawValue;
		},
		Time: function(Value) {
			if (Value.length < 19) {
				return '';
			}

			var RawValue = Value.substr(11, 5);
			if (RawValue == '00:00') {
				return '';
			}

			return RawValue;
		}
	},
	ShowFormat: {
		Date: function(Value) {
			if (Value == null) {
				return '';
			} else if (typeof(Value) == 'string') {
				return Value;
			}

			var Day = Value.getDate();
			var DayText = (Day.toString().length == 1) ? '0' + Day : Day;
			var Month = Value.getMonth() + 1;
			var MonthText = (Month.toString().length == 1) ? '0' + Month : Month;
			var Date = Value.getFullYear() + '-' + MonthText + '-' + DayText;
			return Date;
		},
		Time: function(Value) {
			if (typeof(Value) == 'string' && Value == '') {
				return '00:00';
			}

			var Hour = Value.getHours();
			var HourText = (Hour.toString().length == 1) ? '0' + Hour : Hour;
			var Minute = Value.getMinutes();
			var MinuteText = (Minute.toString().length == 1) ? '0' + Minute : Minute;
			var Time = HourText + ':' + MinuteText;
			return Time;
		}
	},
	InitWindowSize: function(Param) {
		Renderer.AutoWindowSize(Param);
	},
	AutoWindowSize: function(Param) {
		Param.IsTabPanel = (Param.IsTabPanel == null) ? 0 : Param.IsTabPanel;

		if (typeof window.innerWidth != 'undefined') {
			WindowWidth = window.innerWidth;
			WindowHeight = window.innerHeight;
		} else if (typeof document.documentElement != 'undefined' && typeof document.documentElement.clientWidth != 'undefined' && document.documentElement.clientWidth != 0) {
			WindowWidth = document.documentElement.clientWidth,
			WindowHeight = document.documentElement.clientHeight
		} else {
			WindowWidth = document.getElementsByTagName('body')[0].clientWidth;
			WindowHeight = document.getElementsByTagName('body')[0].clientHeight;
		}

		if (Param.Panel == -1) {
			if (Param.IsTabPanel == 0) {
				Param.Grid.setHeight(WindowHeight);
			} else {
				var FreeSpace = WindowHeight - Param.Toolbar;
				FreeSpace = (FreeSpace < 400) ? 400 : FreeSpace;
				var TabActiveID = Param.Grid.getActiveTab().id;

				Param.Grid.setHeight(FreeSpace);
				for (var grid in Param.Grid.grid) {
					if (Param.Grid.grid[grid].TabOwner != null && Param.Grid.grid[grid].TabOwner == TabActiveID) {
						Param.Grid.grid[grid].setHeight(FreeSpace - 24);
					}
				}
			}
		} else {
			Param.Panel.setHeight(WindowHeight);
			Param.Grid.setHeight(WindowHeight - Param.Toolbar);
		}
	}
}