//Override Bootstrap.Popup
Bootstrap.Popup.implement({
	'setTitle':function(sTitle){
		this.element.getElement('.modal-header h3').set('html',sTitle);
		return this;
	},
	'load':function(sUrl,oOptions){
		this.spin();
		if(oOptions == null || 'object' !== typeof oOptions)oOptions = {};
		
		var fSuccess = null;
		if('function' === typeof oOptions.onSuccess){
			fSuccess = oOptions.onSuccess;
			delete oOptions.onSuccess;
		}
		
		var that = this, eBody = this.element.getElement('.modal-body');
		new Request.HTML(Object.merge({
			'method':'get',
			'data':eBody,
			'update':eBody,
			'url':sUrl,
			'onSuccess':function(){
				that.unspin();
				if('function' === typeof fSuccess)fSuccess(that);
			},
			'onFailure' : function(){
				if(this.animating && this.visible)this.addEvent('show',this.hide.bind(this));
				else this.hide();
    		}.bind(this)
		},oOptions)).send();
		return this;
	},
	'spin':function(){
		this.element.getElement('.modal-body').spin({
			'class':'spinner spinner-mask',
			'destroyOnHide':true,
			'containerPosition':{'offset':{'x':-2,'y':0}}
		});
		return this;
	},
	'unspin':function(){
		this.element.getElement('.modal-body').unspin();
		return this;
	}
});

(function(){
	Behavior.addGlobalFilters({
		'BS.DismissPopup': {
			defaults: {},
			setup: function(eElement, api){
				eElement.getElements('[data-dismiss]').each(function(eButton){
					eButton.addEvent('click',function(){
						this.getParent(this.get('data-dismiss')).getElement('.close').click();
					});
				});
				return eElement;
			}
		}
	});
	
	//Override FormValidator setup
	Behavior.getFilter('FormValidator').setup = function(element, api) {
		//instantiate the form validator
		var validator = element.retrieve('validator',new Form.Validator.Inline(element,
			Object.cleanValues(
				api.getAs({
					useTitles: Boolean,
					scrollToErrorsOnSubmit: Boolean,
					scrollToErrorsOnBlur: Boolean,
					scrollToErrorsOnChange: Boolean,
					ignoreHidden: Boolean,
					ignoreDisabled: Boolean,
					useTitles: Boolean,
					evaluateOnSubmit: Boolean,
					evaluateFieldsOnBlur: Boolean,
					evaluateFieldsOnChange: Boolean,
					serial: Boolean,
					stopOnFailure: Boolean
				})
			)
		));
		
		//Disable / enabled submit on element validate
		var eSubmit = element.getElement('input[type=submit]');
		if(eSubmit != null)validator.setOptions({
			onElementPass : function(eElement){
				eSubmit.set('disabled',false);
			},
			onElementFail : function(eElement){
				eSubmit.set('disabled',true);
			}
		});
		
		//if the api provides a getScroller method, which should return an instance of
		//Fx.Scroll, use it instead
		if (api.getScroller) {
			validator.setOptions({
				onShow: function(input, advice, className) {
					api.getScroller().toElement(input);
				},
				scrollToErrorsOnSubmit: false
			});
		}
		api.onCleanup(function(){
			validator.stop();
		});
		return validator;
	};
})();