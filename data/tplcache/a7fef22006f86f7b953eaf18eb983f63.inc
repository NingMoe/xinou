<a href="{dede:field name='typeurl'/}" class="">
                <li class="am-parent">
                  {dede:field name='typename'/}
                  <ul class="am-menu-sub am-collapse  am-avg-sm-3 ">
                    {dede:channel type=son noself=yes}
                      <a href="[field:typelink/]" class="">
                        <li class="">
                          [field:typename/]
                        </li>
                      </a>
                    {/dede:channel}
                  </ul>
                </li>
              </a>