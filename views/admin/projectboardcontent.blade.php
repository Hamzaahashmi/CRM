 {{-- <h5 class="card-title"></h5>
                     Simple MDL Progress Bar -->
                    <div id="p1" class="mdl-progress mdl-js-progress"></div>
                    <script>
                        document.querySelector('#p1').addEventListener('mdl-componentupgraded', function () {
                            this.MaterialProgress.setProgress(44);
                        });

                    </script>  --}}

 {{-- To Do list --}}



 <div class="kanban__title">
     <h1><i class="material-icons">check</i> To do list</h1>
 </div>
 <div class="dd">

     <ol class="kanban To-do">
         <div class="kanban__title">
             <h2>To Do</h2>
         </div>
         {{-- <li class="dd-item" data-id="1"></li> --}}
         @foreach ($todotisckets as $todotiscket)
         <li class="dd-item" data-id="{{$todotiscket['id']}}" id="tic_{{$todotiscket['id']}}"
             style="position: relative">
             <a data-id="{{$todotiscket['id']}}" class="deletebtn"><i class="fas fa-times"
                     style="position:absolute; top:5; right:5; z-index: 1"></i></a>
             <div
                 style="width:30px; height:30px;background-color:rebeccapurple;border-radius: 15px; padding: 4px 0px 0px 8px;">
                 <h4 class="text-white">{{usernameLetter($todotiscket['employe_id'])}}</h4>
             </div>
             <h3 class="title dd-handle">{{$todotiscket['title']}}
             </h3>
             <div class="text" contenteditable="true">
                 <?php  echo $todotiscket['description'] ?>
             </div>

         </li>
         @endforeach
         <li class="dd-item" data-id=""></li>
     </ol>

     {{-- Progress  list --}}
     <ol class="kanban progress">
         <h2>In progress</h2>
         @foreach ($progresstisckets as $progresstiscket)
         <li class="dd-item" data-id="{{$progresstiscket['id']}}" id="tic_{{$progresstiscket['id']}}"
             style="position: relative">
             <a data-id="{{$progresstiscket['id']}}" class="deletebtn"><i class="fas fa-times"
                     style="position:absolute; top:5; right:5; z-index: 1"></i></a>
             <div
                 style="width:30px; height:30px;background-color:rebeccapurple;border-radius: 15px; padding: 4px 0px 0px 8px;">
                 <h4 class="text-white">{{usernameLetter($progresstiscket['employe_id'])}}</h4>
             </div>
             <h3 class="title dd-handle">{{$progresstiscket['title']}}
             </h3>
             <div class="text" contenteditable="true">
                 <?php  echo $progresstiscket['description'] ?>
             </div>

         </li>
         @endforeach
         <li class="dd-item" data-id=""></li>
     </ol>
     {{-- Done list --}}
     <ol class="kanban  Done">
         <h2>Done</h2>
         @foreach ($donetisckets as $donetiscket)
         <li class="dd-item" data-id="{{$donetiscket['id']}}" id="tic_{{$donetiscket['id']}}"
             style="position: relative">
             <a data-id="{{$donetiscket['id']}}" class="deletebtn"><i class="fas fa-times"
                     style="position:absolute; top:5; right:5; z-index: 1"></i></a>
             <div
                 style="width:30px; height:30px;background-color:rebeccapurple;border-radius: 15px; padding: 4px 0px 0px 8px;">
                 <h4 class="text-white">{{usernameLetter($donetiscket['employe_id'])}}</h4>
             </div>
             <h3 class="title dd-handle">{{$donetiscket['title']}}
             </h3>
             <div class="text" contenteditable="true">
                 <?php  echo $donetiscket['description'] ?>
             </div>

         </li>
         @endforeach
         <li class="dd-item"></li>
     </ol>

     {{-- Delete list --}}
     <ol class="kanban Gone">
         <h2>Gone</h2>
         @foreach ($deletetisckets as $deletetiscket)
         <li class="dd-item" data-id="{{$deletetiscket['id']}}" id="tic_{{$deletetiscket['id']}}"
             style="position: relative">
             <a data-id="{{$deletetiscket['id']}}" class="deletebtn"><i class="fas fa-times"
                     style="position:absolute; top:5; right:5; z-index: 1"></i></a>
             <div
                 style="width:30px; height:30px;background-color:rebeccapurple;border-radius: 15px; padding: 4px 0px 0px 8px;">
                 <h4 class="text-white">{{usernameLetter($deletetiscket['employe_id'])}}</h4>
             </div>
             <h3 class="title dd-handle">{{$deletetiscket['title']}}
             </h3>
             <div class="text" contenteditable="true">
                 <?php  echo $deletetiscket['description'] ?>
             </div>

         </li>
         @endforeach
         <li class="dd-item"></li>
     </ol>

 </div>
 <menu class="kanban">
     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adminaddticketModal">
         Add Task
     </button> </menu>

 {{-- Add New Modal  --}}

 <div class="modal fade" id="adminaddticketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                 <button type="button" class="close btn btn-secondary" id="closeaddticketmodal" data-dismiss="modal"
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form class="" id="adminaddticketform">
                     <div class="form-group">
                         <label>Enter Title</label>
                         <input type="text" placeholder="" class="form-control" name="ttitle">
                         <input type="hidden" placeholder="" class="form-control" value="{{$project_id}}" name="pid">
                     </div>
                     <div class="form-group">
                         <label>Enter Description</label>
                         <input type="hidden" name="tdescription" value="" id="summernoteinput3">
                         <div class="form-control" id="summernotes3"></div>
                     </div>

                     <label>Select Employes</label>
                     <div class="form-group">
                         <select class="form-control" style="width:100%;" id="selected_course" name="ticketsuser">
                             @foreach ($userdata as $user)
                             <option value="{{$user['id']}}" style="width:100%;">{{$user['name']}}
                             </option>
                             @endforeach
                         </select>
                     </div>


             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary" id="buttondisabled">
                     <img
                      style="postion:absolute; z-index:1; height:20px " id="loadingpic"
                      src="https://i.gifer.com/origin/b4/b4d657e7ef262b88eb5f7ac021edda87.gif"
                       alt="">
                       Add</button>
             </div>
             </form>
         </div>
     </div>
 </div>
 <!-- Modal end -->


 @section('footerJs')

 <script>
     //  multi select2 default js code
     // $(document).ready(function () {
     //     $(".mul-select").select2({
     //         placeholder: "Select Employes to assign",
     //     });
     // });
      $("#loadingpic").css("display", "none");   
     $(document).ready(function () {
         $('#summernotes3').summernote();
     });

     $(document).on('submit', '#adminaddticketform', function (e) {

          $("#loadingpic").css("display", "block");
          $("#buttondisabled").attr("disabled", true);
         e.preventDefault();
         //  $('#closeaddticketmodal').click();
         var txt = $(".note-editable").html();
         $("#summernoteinput3").val(txt);
         $.ajax({
             url: '{{route("adminaddticket")}}',
             type: 'post',
             data: $("#adminaddticketform").serialize(),
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             success: function (data) {
                $("#loadingpic").css("display", "none");
                 Swal.fire({
                     type: 'success',
                     title: 'save',
                     text: 'Add Successfully'
                 }).then(function () {
                     location.replace("{{route('board',['id'=>$project_id])}}");
                 });

             }


         });

     });

     $(document).on('click', '.deletebtn', function (e) {
         e.preventDefault();

         var id = $(this).attr("data-id");
         if (confirm('Are you sure You want to delete!')) {
             $.ajax({
                 url: '{{route("deleteticket")}}',
                 type: 'post',
                 data: {
                     id: id
                 },
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 success: function (data) {
                     if (data === 'success') {
                         $('#tic_' + id).remove();
                     }
                 }
             });
         }
     });


     /*!
      * Nestable jQuery Plugin - Copyright (c) 2012 David Bushell - http://dbushell.com/
      * Dual-licensed under the BSD or MIT licenses
      */
     ;
     (function ($, window, document, undefined) {
         var hasTouch = 'ontouchstart' in document;

         /**
          * Detect CSS pointer-events property
          * events are normally disabled on the dragging element to avoid conflicts
          * https://github.com/ausi/Feature-detection-technique-for-pointer-events/blob/master/modernizr-pointerevents.js
          */
         var hasPointerEvents = (function () {

             var el = document.createElement('div'),
                 docEl = document.documentElement;
             if (!('pointerEvents' in el.style)) {
                 return false;
             }
             el.style.pointerEvents = 'auto';
             el.style.pointerEvents = 'x';
             docEl.appendChild(el);
             var supports = window.getComputedStyle && window.getComputedStyle(el, '').pointerEvents ===
                 'auto';
             docEl.removeChild(el);
             return !!supports;
         })();

         var defaults = {
             listNodeName: 'ol',
             itemNodeName: 'li',
             rootClass: 'dd',
             listClass: 'dd-list',
             itemClass: 'dd-item',
             dragClass: 'dd-dragel',
             handleClass: 'dd-handle',
             collapsedClass: 'dd-collapsed',
             placeClass: 'dd-placeholder',
             noDragClass: 'dd-nodrag',
             emptyClass: 'dd-empty',
             expandBtnHTML: '<button data-action="expand" type="button">Expand</button>',
             collapseBtnHTML: '<button data-action="collapse" type="button">Collapse</button>',
             group: 0,
             maxDepth: 5,
             threshold: 20
         };

         function Plugin(element, options) {

             this.w = $(document);
             this.el = $(element);
             this.options = $.extend({}, defaults, options);
             this.init();
         }

         Plugin.prototype = {

             init: function () {

                 var list = this;

                 list.reset();

                 list.el.data('nestable-group', this.options.group);

                 list.placeEl = $('<div class="' + list.options.placeClass + '"/>');

                 $.each(this.el.find(list.options.itemNodeName), function (k, el) {
                     list.setParent($(el));
                 });

                 list.el.on('click', 'button', function (e) {
                     if (list.dragEl) {
                         return;
                     }
                     var target = $(e.currentTarget),
                         action = target.data('action'),
                         item = target.parent(list.options.itemNodeName);
                     if (action === 'collapse') {
                         list.collapseItem(item);
                     }
                     if (action === 'expand') {
                         list.expandItem(item);
                     }
                 });

                 var onStartEvent = function (e) {
                     var handle = $(e.target);
                     if (!handle.hasClass(list.options.handleClass)) {
                         if (handle.closest('.' + list.options.noDragClass).length) {
                             return;
                         }
                         handle = handle.closest('.' + list.options.handleClass);
                     }

                     if (!handle.length || list.dragEl) {
                         return;
                     }

                     list.isTouch = /^touch/.test(e.type);
                     if (list.isTouch && e.touches.length !== 1) {
                         return;
                     }

                     e.preventDefault();
                     list.dragStart(e.touches ? e.touches[0] : e);
                 };

                 var onMoveEvent = function (e) {
                     if (list.dragEl) {
                         e.preventDefault();
                         list.dragMove(e.touches ? e.touches[0] : e);
                     }
                 };

                 var onEndEvent = function (e) {
                     if (list.dragEl) {
                         e.preventDefault();
                         list.dragStop(e.touches ? e.touches[0] : e);
                     }
                 };

                 if (hasTouch) {
                     list.el[0].addEventListener('touchstart', onStartEvent, false);
                     window.addEventListener('touchmove', onMoveEvent, false);
                     window.addEventListener('touchend', onEndEvent, false);
                     window.addEventListener('touchcancel', onEndEvent, false);
                 }

                 list.el.on('mousedown', onStartEvent);
                 list.w.on('mousemove', onMoveEvent);
                 list.w.on('mouseup', onEndEvent);

             },

             serialize: function () {

                 var data,
                     depth = 0,
                     list = this;
                 step = function (level, depth) {
                     var array = [],
                         items = level.children(list.options.itemNodeName);
                     items.each(function () {
                         var li = $(this),
                             item = $.extend({}, li.data()),
                             sub = li.children(list.options.listNodeName);
                         if (sub.length) {
                             item.children = step(sub, depth + 1);
                         }
                         array.push(item);
                     });
                     return array;
                 };
                 data = step(list.el.find(list.options.listNodeName).first(), depth);
                 return data;
             },

             serialise: function () {

                 return this.serialize();
             },

             reset: function () {
                 this.mouse = {
                     offsetX: 0,
                     offsetY: 0,
                     startX: 0,
                     startY: 0,
                     lastX: 0,
                     lastY: 0,
                     nowX: 0,
                     nowY: 0,
                     distX: 0,
                     distY: 0,
                     dirAx: 0,
                     dirX: 0,
                     dirY: 0,
                     lastDirX: 0,
                     lastDirY: 0,
                     distAxX: 0,
                     distAxY: 0
                 };
                 this.isTouch = false;
                 this.moving = false;
                 this.dragEl = null;
                 this.dragRootEl = null;
                 this.dragDepth = 0;
                 this.hasNewRoot = false;
                 this.pointEl = null;
             },

             expandItem: function (li) {

                 li.removeClass(this.options.collapsedClass);
                 li.children('[data-action="expand"]').hide();
                 li.children('[data-action="collapse"]').show();
                 li.children(this.options.listNodeName).show();
             },

             collapseItem: function (li) {

                 var lists = li.children(this.options.listNodeName);
                 if (lists.length) {
                     li.addClass(this.options.collapsedClass);
                     li.children('[data-action="collapse"]').hide();
                     li.children('[data-action="expand"]').show();
                     li.children(this.options.listNodeName).hide();
                 }
             },

             expandAll: function () {

                 var list = this;
                 list.el.find(list.options.itemNodeName).each(function () {
                     list.expandItem($(this));
                 });
             },

             collapseAll: function () {

                 var list = this;
                 list.el.find(list.options.itemNodeName).each(function () {
                     list.collapseItem($(this));
                 });
             },

             setParent: function (li) {

                 if (li.children(this.options.listNodeName).length) {
                     li.prepend($(this.options.expandBtnHTML));
                     li.prepend($(this.options.collapseBtnHTML));
                 }
                 li.children('[data-action="expand"]').hide();
             },

             unsetParent: function (li) {
                 li.removeClass(this.options.collapsedClass);
                 li.children('[data-action]').remove();
                 li.children(this.options.listNodeName).remove();
             },

             dragStart: function (e) {
                 var mouse = this.mouse,
                     target = $(e.target),
                     dragItem = target.closest(this.options.itemNodeName);

                 this.placeEl.css('height', dragItem.height());

                 mouse.offsetX = e.offsetX !== undefined ? e.offsetX : e.pageX - target.offset().left;
                 mouse.offsetY = e.offsetY !== undefined ? e.offsetY : e.pageY - target.offset().top;
                 mouse.startX = mouse.lastX = e.pageX;
                 mouse.startY = mouse.lastY = e.pageY;

                 this.dragRootEl = this.el;

                 this.dragEl = $(document.createElement(this.options.listNodeName)).addClass(this.options
                     .listClass + ' ' + this.options.dragClass);
                 this.dragEl.css('width', dragItem.width());

                 dragItem.after(this.placeEl);
                 dragItem[0].parentNode.removeChild(dragItem[0]);
                 dragItem.appendTo(this.dragEl);

                 $(document.body).append(this.dragEl);
                 this.dragEl.css({
                     'left': e.pageX - mouse.offsetX,
                     'top': e.pageY - mouse.offsetY
                 });
                 // total depth of dragging item
                 var i, depth,
                     items = this.dragEl.find(this.options.itemNodeName);
                 for (i = 0; i < items.length; i++) {
                     depth = $(items[i]).parents(this.options.listNodeName).length;
                     if (depth > this.dragDepth) {
                         this.dragDepth = depth;
                     }
                 }
             },

             dragStop: function (e) {
                 var el = this.dragEl.children(this.options.itemNodeName).first();
                 el[0].parentNode.removeChild(el[0]);
                 this.placeEl.replaceWith(el);
                 this.dragEl.remove();
                 this.el.trigger('change');
                 if (this.hasNewRoot) {
                     console.log(this.dragRootEl.trigger('change'));
                 }
                 this.reset();
                 $(el).attr('data-id');
                 var cname = $(el[0].parentNode).attr('class');
                 var id = $(el).attr('data-id');
                 $.ajax({
                     url: '{{route("updticketstatus")}}',
                     type: 'post',
                     data: {
                         id: id,
                         cname: cname
                     },
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     success: function (data) {

                     }
                 });

             },

             dragMove: function (e) {

                 var list, parent, prev, next, depth,
                     opt = this.options,
                     mouse = this.mouse;

                 this.dragEl.css({
                     'left': e.pageX - mouse.offsetX,
                     'top': e.pageY - mouse.offsetY
                 });

                 // mouse position last events
                 mouse.lastX = mouse.nowX;
                 mouse.lastY = mouse.nowY;
                 // mouse position this events
                 mouse.nowX = e.pageX;
                 mouse.nowY = e.pageY;
                 // distance mouse moved between events
                 mouse.distX = mouse.nowX - mouse.lastX;
                 mouse.distY = mouse.nowY - mouse.lastY;
                 // direction mouse was moving
                 mouse.lastDirX = mouse.dirX;
                 mouse.lastDirY = mouse.dirY;
                 // direction mouse is now moving (on both axis)
                 mouse.dirX = mouse.distX === 0 ? 0 : mouse.distX > 0 ? 1 : -1;
                 mouse.dirY = mouse.distY === 0 ? 0 : mouse.distY > 0 ? 1 : -1;
                 // axis mouse is now moving on
                 var newAx = Math.abs(mouse.distX) > Math.abs(mouse.distY) ? 1 : 0;

                 // do nothing on first move
                 if (!mouse.moving) {
                     mouse.dirAx = newAx;
                     mouse.moving = true;
                     return;
                 }

                 // calc distance moved on this axis (and direction)
                 if (mouse.dirAx !== newAx) {
                     mouse.distAxX = 0;
                     mouse.distAxY = 0;
                 } else {
                     mouse.distAxX += Math.abs(mouse.distX);
                     if (mouse.dirX !== 0 && mouse.dirX !== mouse.lastDirX) {
                         mouse.distAxX = 0;
                     }
                     mouse.distAxY += Math.abs(mouse.distY);
                     if (mouse.dirY !== 0 && mouse.dirY !== mouse.lastDirY) {
                         mouse.distAxY = 0;
                     }
                 }
                 mouse.dirAx = newAx;

                 /**
                  * move horizontal
                  */

                 if (mouse.dirAx && mouse.distAxX >= opt.threshold) {
                     // reset move distance on x-axis for new phase
                     mouse.distAxX = 0;
                     prev = this.placeEl.prev(opt.itemNodeName);
                     // increase horizontal level if previous sibling exists and is not collapsed
                     if (mouse.distX > 0 && prev.length && !prev.hasClass(opt.collapsedClass)) {
                         // cannot increase level when item above is collapsed
                         list = prev.find(opt.listNodeName).last();
                         // check if depth limit has reached
                         depth = this.placeEl.parents(opt.listNodeName).length;
                         if (depth + this.dragDepth <= opt.maxDepth) {
                             // create new sub-level if one doesn't exist
                             if (!list.length) {
                                 list = $('<' + opt.listNodeName + '/>').addClass(opt.listClass);
                                 list.append(this.placeEl);
                                 prev.append(list);
                                 this.setParent(prev);
                             } else {
                                 // else append to next level up
                                 list = prev.children(opt.listNodeName).last();
                                 list.append(this.placeEl);
                             }
                         }
                     }
                     // decrease horizontal level
                     if (mouse.distX < 0) {
                         // we can't decrease a level if an item preceeds the current one
                         next = this.placeEl.next(opt.itemNodeName);
                         if (!next.length) {
                             parent = this.placeEl.parent();
                             this.placeEl.closest(opt.itemNodeName).after(this.placeEl);
                             if (!parent.children().length) {
                                 this.unsetParent(parent.parent());
                             }
                         }
                     }
                 }

                 var isEmpty = false;

                 // find list item under cursor
                 if (!hasPointerEvents) {
                     this.dragEl[0].style.visibility = 'hidden';
                 }
                 this.pointEl = $(document.elementFromPoint(e.pageX - document.body.scrollLeft, e.pageY -
                     (window.pageYOffset || document.documentElement.scrollTop)));
                 if (!hasPointerEvents) {
                     this.dragEl[0].style.visibility = 'visible';
                 }
                 if (this.pointEl.hasClass(opt.handleClass)) {
                     this.pointEl = this.pointEl.parent(opt.itemNodeName);
                 }
                 if (this.pointEl.hasClass(opt.emptyClass)) {
                     isEmpty = true;
                 } else if (!this.pointEl.length || !this.pointEl.hasClass(opt.itemClass)) {
                     return;
                 }

                 // find parent list of item under cursor
                 var pointElRoot = this.pointEl.closest('.' + opt.rootClass),
                     isNewRoot = this.dragRootEl.data('nestable-id') !== pointElRoot.data('nestable-id');

                 /**
                  * move vertical
                  */
                 if (!mouse.dirAx || isNewRoot || isEmpty) {
                     // check if groups match if dragging over new root
                     if (isNewRoot && opt.group !== pointElRoot.data('nestable-group')) {
                         return;
                     }
                     // check depth limit
                     depth = this.dragDepth - 1 + this.pointEl.parents(opt.listNodeName).length;
                     if (depth > opt.maxDepth) {
                         return;
                     }
                     var before = e.pageY < (this.pointEl.offset().top + this.pointEl.height() / 2);
                     parent = this.placeEl.parent();
                     // if empty create new list to replace empty placeholder
                     if (isEmpty) {
                         list = $(document.createElement(opt.listNodeName)).addClass(opt.listClass);
                         list.append(this.placeEl);
                         this.pointEl.replaceWith(list);
                     } else if (before) {
                         this.pointEl.before(this.placeEl);
                     } else {
                         this.pointEl.after(this.placeEl);
                     }
                     if (!parent.children().length) {
                         this.unsetParent(parent.parent());
                     }
                     if (!this.dragRootEl.find(opt.itemNodeName).length) {
                         this.dragRootEl.append('<div class="' + opt.emptyClass + '"/>');
                     }
                     // parent root list has changed
                     if (isNewRoot) {
                         this.dragRootEl = pointElRoot;
                         this.hasNewRoot = this.el[0] !== this.dragRootEl[0];
                     }
                 }
             }

         };

         $.fn.nestable = function (params) {

             var lists = this,
                 retval = this;

             lists.each(function () {
                 var plugin = $(this).data("nestable");

                 if (!plugin) {
                     $(this).data("nestable", new Plugin(this, params));
                     $(this).data("nestable-id", new Date().getTime());
                 } else {
                     if (typeof params === 'string' && typeof plugin[params] === 'function') {
                         retval = plugin[params]();
                     }
                 }
             });

             return retval || lists;
         };

     })(window.jQuery || window.Zepto, window, document);
     /*my scripts*/
     $('.dd').nestable('serialize');
     $('.viewlist').on('click', function () {
         $('ol.kanban').addClass('list')
         $('ol.list').removeClass('kanban')
         $('menu').addClass('list')
         $('menu').removeClass('kanban')
     });
     $('.viewkanban').on('click', function () {
         $('ol.list').addClass('kanban')
         $('ol.kanban').removeClass('list')
         $('menu').addClass('kanban')
         $('menu').removeClass('list')
     });
     /*colors*/
     // $('#color').spectrum({
     //     color: "#f00",
     //     change: function (color) {
     //         $("#label").text("change called: " + color.toHexString());
     //     }
     // });

 </script>
 @endsection
